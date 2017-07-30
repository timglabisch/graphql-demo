<?php

namespace Tg\EasyGraphApi\Graph\Invoice\Type\Query;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Tg\DocumentDomain\Requirement\DocumentRequirement;
use Tg\DocumentInvoiceDomain\Requirement\DocumentInvoiceRequirement;
use Tg\EasyGraphApi\Graph\Context;
use Tg\EasyGraphApi\Helper\SingletonTrait;

class GraphQueryInvoiceType extends ObjectType
{
    use SingletonTrait;

    public function __construct()
    {
        parent::__construct(
            [
                'fields' => [
                    'title' => [
                        'type' => Type::string(),
                    ]
                ],
                'resolveField' => function (DocumentInvoiceRequirement $requirement, $args, Context $context, ResolveInfo $info) {

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