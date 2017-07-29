<?php

namespace Tg\PersistenceDomain\Requirement;


interface ResolveableInterface
{
    public function resolve($value);

    public function isResolved(): bool;

    public function getResolvedValue();

}