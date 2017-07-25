<?php

namespace Tg\EasyGraphApi\Graph\Document\Type\Query;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\Helper\SingletonTrait;
use Tg\EasyGraphApi\Requirement\Document\DocumentRequirement;

class GraphQueryDocumentType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'fields' => [
                    'document_type' => [
                        'type' => Type::string(),
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ]
                ],
                'resolveField' => function (DocumentRequirement $requirement, $args, Context $context, ResolveInfo $info) {

                    $requirement->addField($info->fieldName);

                    return new \GraphQL\Deferred(
                        function () use ($requirement, $context, $info) {
                            $context->resolve();

                            return $requirement->getResolvedValue()[$info->fieldName];
                        }
                    );
                }
            ]
        );
    }

}