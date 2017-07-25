<?php

namespace Tg\EasyGraphApi\GraphType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;

class MutationGraphType extends ObjectType
{
    public function __construct(GraphTypeRegistry $typeRegistry)
    {
        parent::__construct([
            'name' => 'Mutation',
            'fields' => [
                'document' => [
                    'type' => $typeRegistry->getDocumentMutation()
                ]
            ],
            'resolveField' => function($val, $args, Context $context, ResolveInfo $info) {
                return [];
            }
        ]);
    }

}