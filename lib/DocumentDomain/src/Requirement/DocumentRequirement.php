<?php

namespace Tg\Document\Requirement;

use Tg\DocumentDomain\DocumentReferenceInterface;
use Tg\RequirementDomain\Requirement\ResolveableInterface;
use Tg\RequirementDomain\Requirement\ResolveableTrait;

class DocumentRequirement implements ResolveableInterface
{
    use ResolveableTrait;

    private $documentReference;

    private $fields;

    public function getId(): string
    {
        return $this->documentReference->getDocumentId();
    }

    public function __construct(DocumentReferenceInterface $documentReference)
    {
        $this->documentReference = $documentReference;
    }

    public function addField(string $field)
    {
        $this->fields[] = $field;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}