<?php

namespace Tg\Persistence\Requirement;

trait ResolveableTrait
{
    private $resolvedValue;

    private $isResolved = false;

    public function resolve($value)
    {
        $this->isResolved = true;
        $this->resolvedValue = $value;
    }

    public function isResolved(): bool
    {
        return $this->isResolved;
    }

    public function getResolvedValue()
    {
        if (!$this->isResolved) {
            throw new \LogicException("value is not Resolved yet");
        }

        return $this->resolvedValue;
    }

}