<?php

namespace Tg\EasyGraphApi\Graph\Document\Type\Query;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Tg\Document\Requirement\DocumentRequirement;
use Tg\EasyGraphApi\Graph\Context;
use Tg\EasyGraphApi\Helper\SingletonTrait;

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

                            $accessor = PropertyAccess::createPropertyAccessor();

                            return $accessor->getValue(
                                $requirement->getResolvedValue(),
                                $info->fieldName
                            );
                        }
                    );
                }
            ]
        );
    }

}