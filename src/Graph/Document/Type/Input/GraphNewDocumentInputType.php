<?php

namespace Tg\EasyGraphApi\Graph\Document\Type\Input;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Graph\Context;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphNewDocumentInputType extends InputObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'fields' => [
                    'documentID' => [
                        'type' => Type::string(),
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ]
                ],
                'resolveField' => function ($val, $args, Context $context, ResolveInfo $info) {
                    return $val[$info->fieldName];
                }

            ]
        );
    }

}