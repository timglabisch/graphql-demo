<?php

namespace Tg\EasyGraphApi\GraphType\Document;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class CreateDocumentMutationType extends InputObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'name' => 'CreateDocumentMutationType',
                'fields' => [
                    'documentID' => [
                        'type' => Type::string(),
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ]
                ],
                'resolveField' => function($val, $args, Context $context, ResolveInfo $info) {
                    return $val[$info->fieldName];
                }

            ]
        );
    }

}