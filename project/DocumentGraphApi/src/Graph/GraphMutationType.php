<?php

namespace Tg\EasyGraphApi\Graph;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use Tg\EasyGraphApi\Graph\Document\GraphMutationDocument;
use Tg\EasyGraphApi\Graph\Invoice\GraphMutationInvoice;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphMutationType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'name' => 'Mutation',
                'fields' => [
                    'document' => [
                        'type' => GraphMutationDocument::getType()
                    ],
                    'invoice' => [
                        'type' => GraphMutationInvoice::getType()
                    ]
                ],
                'resolveField' => function ($val, $args, Context $context, ResolveInfo $info) {
                    return []; // just pass down
                }
            ]
        );
    }

}