<?php

namespace Tg\EasyGraphApi\GraphType\Document;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Requirement\Document\DocumentRequirement;

class MutationDocument extends ObjectType
{
    public function __construct(GraphTypeRegistry $typeRegistry)
    {
        parent::__construct([
            'name' => 'documentx',
            'fields' => [
                'create' => [
                    'type' => $typeRegistry->getTypeDocument(),
                    'args' => ['document' => ['type' => Type::nonNull($typeRegistry->getDocumentMutationType())]],
                ]
            ],
            'resolveField' => function($val, $args, Context $context, ResolveInfo $info) {

                // create document
                $document = [
                    $args['document']['documentID'],
                    $args['document']['title']
                ];

                $a = 0;

                if ($info->fieldName === "create") {
                    return $context->addRequirement(new DocumentRequirement($args['document']['documentID']));
                }

                throw new \LogicException('nope');
            }
        ]);
    }
}