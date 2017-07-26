<?php

namespace Tg\EasyGraphApi\Graph;

use Tg\EasyGraphApi\Requirement\ResolveableInterface;
use Tg\EasyGraphApi\Service\RequirementResolver;

class Context
{
    /** @var ResolveableInterface[] */
    private $requirements = [];

    /** @var RequirementResolver */
    private $requirementResolver;

    public function __construct(RequirementResolver $requirementResolver)
    {
        $this->requirementResolver = $requirementResolver;
    }

    public function hasUnresolvedRequirement(): bool
    {
        foreach ($this->requirements as $requirement) {
            if (!$requirement->isResolved()) {
                return true;
            }
        }

        return false;
    }

    public function addRequirement($requirement)
    {
        $this->requirements[] = $requirement;

        return $requirement;
    }

    public function resolve()
    {
        if (!$this->hasUnresolvedRequirement()) {
            return;
        }

        $this->requirementResolver->resolveAll(
            $this->requirements
        );
    }
}