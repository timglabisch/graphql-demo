<?php

namespace Tg\RequirementDomain\Requirement;


interface ResolveableInterface
{
    public function resolve($value);

    public function isResolved(): bool;

    public function getResolvedValue();

}