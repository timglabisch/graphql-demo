<?php

namespace Tg\EasyGraphApi\GraphType\Document;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\Helper\SingletonTrait;
use Tg\EasyGraphApi\Requirement\Document\DocumentRequirement;

class MutationDocument extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct([
            'name' => 'documentx',
            'fields' => [
                'create' => [
                    'type' => GraphTypeDocument::getType(),
                    'args' => ['document' => ['type' => Type::nonNull(CreateDocumentMutationType::getType())]],
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