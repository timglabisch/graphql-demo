<?php

namespace Tg\Persistence\Requirement;


interface ResolveableInterface
{
    public function resolve($value);

    public function isResolved(): bool;

    public function getResolvedValue();

}