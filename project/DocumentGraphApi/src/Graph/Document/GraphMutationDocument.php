<?php

namespace Tg\EasyGraphApi\Graph\Document;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\Document\Requirement\DocumentRequirement;
use Tg\DocumentDomain\DocumentReference;
use Tg\EasyGraphApi\Graph\Context;
use Tg\EasyGraphApi\Graph\Document\Type\Input\GraphNewDocumentInputType;
use Tg\EasyGraphApi\Graph\Document\Type\Query\GraphQueryDocumentType;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphMutationDocument extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'fields' => [
                    'create' => [
                        'type' => GraphQueryDocumentType::getType(),
                        'args' => ['document' => ['type' => Type::nonNull(GraphNewDocumentInputType::getType())]],
                        'resolve' => function ($val, $args, Context $context, ResolveInfo $info) {

                            // create document
                            $document = [
                                $args['document']['documentID'],
                                $args['document']['title']
                            ];

                            return $context->addRequirement(new DocumentRequirement(new DocumentReference($args['document']['documentID'])));
                        }
                    ]
                ]
            ]
        );
    }
}