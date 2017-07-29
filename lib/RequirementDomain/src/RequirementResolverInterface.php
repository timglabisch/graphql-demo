<?php

namespace Tg\RequirementDomain;

use Tg\RequirementDomain\Requirement\ResolveableInterface;

interface RequirementResolverInterface
{
    /** @param ResolveableInterface[] $resolveables */
    public function resolveAll(array $resolveables);
}