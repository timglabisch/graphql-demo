<?php

use GraphQL\GraphQL;
use GraphQL\Schema;
use Tg\EasyGraphApi\Context;
use Tg\EasyGraphApi\GraphTypeRegistry;
use Tg\EasyGraphApi\RequirementResolver;

require __DIR__ . '/vendor/autoload.php';



$typeRegistry = new GraphTypeRegistry();


$schema = new Schema(
    [
        'query' => $typeRegistry->getTypeQuery(),
    ]
);

$input = [
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
$result = GraphQL::execute($schema, $input['query'], null, $context, $input['variables']);

var_dump($result);