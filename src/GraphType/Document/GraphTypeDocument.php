<?php

namespace Tg\EasyGraphApi\GraphType\Document;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Requirement\Document\DocumentRequirement;

class GraphTypeDocument extends ObjectType
{
    public function __construct(GraphTypeRegistry $typeRegistry)
    {
        parent::__construct(
            [
                'name' => 'document',
                'fields' => [
                    'document_type' => [
                        'type' => Type::string(),
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ]
                ],
                'resolveField' => function(DocumentRequirement $requirement, $args, Context $context, ResolveInfo $info) {

                    $requirement->addField($info->fieldName);

                    return new \GraphQL\Deferred(function () use ($requirement, $context, $info) {
                        $context->resolve();

                        return $requirement->getResolvedValue()[$info->fieldName];
                    });
                }
            ]
        );
    }

}