<?php

namespace Tg\RequirementDomain\Service;

use Tg\RequirementDomain\Requirement\ResolveableInterface;
use Tg\RequirementDomain\RequirementResolverInterface;

class ChainedRequirementResolver implements RequirementResolverInterface
{
    /** @var RequirementResolverInterface[] */
    private $resolvers = [];

    /** @param $resolvers RequirementResolverInterface[] */
    public function __construct(array $resolvers)
    {
        $this->resolvers = $resolvers;
    }

    /**
     * @param ResolveableInterface[] $data
     */
    public function resolveAll(array $data)
    {
        $buffer = [];

        foreach ($this->resolvers as $key => $resolver) {
            $buffer[$key] = [];
        }

        foreach ($data as $v) {
            foreach ($this->resolvers as $key => $resolver) {
                if ($resolver->supports($v)) {
                    $buffer[$key][] = $v;
                    continue 2;
                }
            }

            throw new \LogicException("could not find resolver.");
        }

        foreach ($this->resolvers as $key => $resolver) {
            $resolver->resolveAll($buffer[$key]);
        }

        foreach ($data as $v) {
            if (!$v->isResolved()) {
                throw new \LogicException("resolver didnt resolve all requirements.");
            }
        }
    }
}