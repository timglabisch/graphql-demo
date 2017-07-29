<?php

namespace Tg\EasyGraphApi\Graph;

use Tg\RequirementDomain\Requirement\ResolveableInterface;
use Tg\RequirementDomain\Service\ChainedRequirementResolver;

class Context
{
    /** @var ResolveableInterface[] */
    private $requirements = [];

    /** @var ChainedRequirementResolver */
    private $requirementResolver;

    public function __construct(ChainedRequirementResolver $requirementResolver)
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