<?php

namespace Tg\EasyGraphApi;


use Tg\EasyGraphApi\Requirement\Document\ResolveableInterface;
use Tg\EasyGraphApi\RequirementResolver\DocumentRequirementResolver;

class RequirementResolver
{
    /** @var DocumentRequirementResolver[] */
    private $resolvers = [];

    public function __construct()
    {
        $this->resolvers = [
            new DocumentRequirementResolver()
        ];
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