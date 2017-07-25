<?php

namespace Tg\EasyGraphApi\GraphType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphType\Document\GraphTypeDocument;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Helper\SingletonTrait;
use Tg\EasyGraphApi\Requirement\Document\DocumentRequirement;

class QueryGraphType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'document' => [
                    'type' => GraphTypeDocument::getType(),
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