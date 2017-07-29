<?php

namespace Tg\EasyGraphApi\Graph;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\Document\Requirement\DocumentRequirement;
use Tg\EasyGraphApi\Graph\Document\Type\Query\GraphQueryDocumentType;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphQueryType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'name' => 'Query',
                'fields' => [
                    'document' => [
                        'type' => GraphQueryDocumentType::getType(),
                        'args' => ['id' => ['type' => Type::string()]],
                    ]

                ],
                'resolveField' => function ($val, $args, Context $context, ResolveInfo $info) {

                    if ($info->fieldName === "document") {
                        return $context->addRequirement(new DocumentRequirement($args['id']));
                    }

                    throw new \LogicException();
                }
            ]
        );
    }

}