<?php

namespace Tg\EasyGraphApi\GraphType\Document;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use Tg\EasyGraphApi\GraphTypeRegistry;

class CreateDocumentMutationType extends InputObjectType
{
    public function __construct(GraphTypeRegistry $typeRegistry)
    {
        parent::__construct(
            [
                'name' => 'CreateDocumentMutationType',
                'fields' => [
                    'documentID' => [
                        'type' => Type::string(),
                    ],
                    'title' => [
                        'type' => Type::string(),
                    ]
                ]
            ]
        );
    }

}