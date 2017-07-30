<?php

namespace Tg\EasyGraphApi\Graph;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Tg\DocumentDomain\Requirement\DocumentRequirement;
use Tg\DocumentInvoiceDomain\DocumentInvoiceReference;
use Tg\DocumentInvoiceDomain\Requirement\DocumentInvoiceRequirement;
use Tg\EasyGraphApi\Graph\Document\Type\Query\GraphQueryDocumentType;
use Tg\EasyGraphApi\Graph\Invoice\Type\Query\GraphQueryInvoiceType;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphQueryType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'name' => 'Query',
                'fields' => [
                    'document' => [
                        'type' => GraphQueryDocumentType::getType(),
                        'args' => ['id' => ['type' => Type::string()]],
                        'resolve' => function ($val, $args, Context $context, ResolveInfo $info) {
                            return $context->addRequirement(new DocumentRequirement($args['id']));
                        }
                    ],
                    'invoice' => [
                        'type' => GraphQueryInvoiceType::getType(),
                        'args' => ['id' => ['type' => Type::string()]],
                        'resolve' => function ($val, $args, Context $context, ResolveInfo $info) {
                            return $context->addRequirement(new DocumentInvoiceRequirement(new DocumentInvoiceReference($args['id'])));
                        }
                    ]

                ]
            ]
        );
    }

}