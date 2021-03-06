<?php

namespace Tg\Document\Service;

use Tg\Document\Collection\FieldColumnMap;
use Tg\Document\Dto\Document;
use Tg\Document\Requirement\DocumentRequirement;
use Tg\RequirementDomain\Requirement\ResolveableInterface;

class DocumentRequirementResolver
{
    private $map;

    public function __construct()
    {
        $this->map = new FieldColumnMap(
            [
                'title' => 'title',
                'document_type' => 'document_type'
            ]
        );
    }

    public function supports(ResolveableInterface $requirement)
    {
        return $requirement instanceof DocumentRequirement;
    }

    /** @param DocumentRequirement[] $requirements */
    private function getFieldsThatShouldBeResolved(array $requirements): array
    {
        $buffer = [];

        foreach ($requirements as $requirement) {

            if ($requirement->isResolved()) {
                continue;
            }

            foreach ($requirement->getFields() as $field) {
                $buffer[] = $field;
            }
        }

        return array_values(array_unique($buffer));
    }

    /** @param DocumentRequirement[] $requirements */
    private function getDocumentIdsToResolve($requirements): array
    {
        $buffer = [];

        foreach ($requirements as $requirement) {

            if ($requirement->isResolved()) {
                continue;
            }

            $buffer[] = $requirement->getId();
        }

        return array_values(array_unique($buffer));
    }

    /**
     * @param DocumentRequirement[] $requirements
     */
    private function fetchDataFromStore(array $requirements)
    {

        $fields = $this->getFieldsThatShouldBeResolved($requirements);
        $ids = $this->getDocumentIdsToResolve($requirements);

        $columns = $this->map->getColumns($fields);

        $query = '
            SELECT ' . implode(',', $columns) . '
            FROM documents
            WHERE documents.documentID IN (' . implode(',', $ids) . ')
        ';

    }

    /**
     * @return mixed
     */
    public function resolveAndReturn(ResolveableInterface $requirement)
    {
        $this->resolveAll([$requirement]);

        return $requirement->getResolvedValue();
    }

    /**
     * @param ResolveableInterface[] $requirements
     * @return ResolveableInterface[]
     */
    public function resolveAll(array $requirements): array
    {
        foreach ($requirements as $requirement) {
            if (!$requirement instanceof DocumentRequirement) {
                throw new \RuntimeException();
            }
        }

        foreach ($requirements as $requirement) {
            $requirement->resolve(
                Document::fromArray([
                    'title' => 'title_' . $requirement->getId(),
                    'document_type' => 'document_type_' . $requirement->getId()
                ])
            );
        }

        return $requirements;

    }

}