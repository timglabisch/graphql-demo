<?php

namespace Tg\Document\Requirement;

use Tg\RequirementDomain\Requirement\ResolveableInterface;
use Tg\RequirementDomain\Requirement\ResolveableTrait;

class DocumentRequirement implements ResolveableInterface
{
    use ResolveableTrait;

    private $id;

    private $fields;

    public function getId(): string
    {
        return $this->id;
    }

    public function __construct(string $id)
    {
        $this->id = $id;
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