<?php

use GraphQL\GraphQL;
use GraphQL\Schema;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\Graph\GraphMutationType;
use Tg\EasyGraphApi\Graph\GraphQueryType;
use Tg\EasyGraphApi\RequirementResolver;

require __DIR__ . '/vendor/autoload.php';


$schema = new Schema(
    [
        'query' => GraphQueryType::getType(),
        'mutation' => GraphMutationType::getType(),
    ]
);

$input = [

    'mutation' => '
    
        mutation {
            document {
                create(
                    document: {
                        documentID: "a",
                        title: "b"
                    }
                ) {
                    title
                    document_type
                }
            }
        }
    
    ',


    'query' => '
    
        query {
           document10: document(id: "10") {
            title
            document_type
           }
           document9: document(id: "9") {
            title
           }
        }
        
    ',
    'variables' => []
];

$resolver = new RequirementResolver();

$context = new Context($resolver);
//$result = GraphQL::execute($schema, $input['query'], null, $context, $input['variables']);
$result = GraphQL::execute($schema, $input['mutation'], null, $context, $input['variables']);

var_dump($result);