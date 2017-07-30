<?php

namespace Tg\EasyGraphApi\Graph\Invoice;


use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\DocumentDomain\DocumentReference;
use Tg\DocumentDomain\Requirement\DocumentRequirement;
use Tg\DocumentInvoiceDomain\DocumentInvoiceReference;
use Tg\DocumentInvoiceDomain\Requirement\DocumentInvoiceRequirement;
use Tg\EasyGraphApi\Graph\Context;
use Tg\EasyGraphApi\Graph\Document\Type\Input\GraphNewDocumentInputType;
use Tg\EasyGraphApi\Graph\Document\Type\Query\GraphQueryDocumentType;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphMutationInvoice extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'fields' => [
                    'create' => [
                        'type' => GraphQueryDocumentType::getType(),
                        'args' => ['invoice' => ['type' => Type::nonNull(GraphNewDocumentInputType::getType())]],
                        'resolve' => function ($val, $args, Context $context, ResolveInfo $info) {

                            // create document
                            $document = [
                                $args['document']['documentID'],
                                $args['document']['title']
                            ];

                            return $context->addRequirement(new DocumentInvoiceRequirement(new DocumentInvoiceReference($args['document']['documentID'])));
                        }
                    ]
                ]
            ]
        );
    }
}