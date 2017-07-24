<?php

namespace Tg\EasyGraphApi\GraphType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Requirement\Document\DocumentRequirement;

class QueryGraphType extends ObjectType
{
    public function __construct(GraphTypeRegistry $typeRegistry)
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'document' => [
                    'type' => $typeRegistry->getTypeDocument(),
                    'args' => ['id' => ['type' => Type::string()]],
                ]

            ],
            'resolveField' => function($val, $args, Context $context, ResolveInfo $info) {

                if ($info->fieldName === "document") {
                    return $context->addRequirement(new DocumentRequirement($args['id']));
                }

                return "nöpe";
            }
        ]);
    }

}