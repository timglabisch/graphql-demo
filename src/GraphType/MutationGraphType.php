<?php

namespace Tg\EasyGraphApi\GraphType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphType\Document\MutationDocument;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class MutationGraphType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct([
            'name' => 'Mutation',
            'fields' => [
                'document' => [
                    'type' => MutationDocument::getType()
                ]
            ],
            'resolveField' => function($val, $args, Context $context, ResolveInfo $info) {
                return [];
            }
        ]);
    }

}