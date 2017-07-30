<?php

use GraphQL\GraphQL;
use GraphQL\Schema;
use Tg\Document\Service\DocumentRequirementResolver;
use Tg\DocumentInvoice\Service\DocumentInvoiceRequirementResolver;
use Tg\EasyGraphApi\Graph\Context;
use Tg\EasyGraphApi\Graph\GraphMutationType;
use Tg\EasyGraphApi\Graph\GraphQueryType;
use Tg\RequirementDomain\Service\ChainedRequirementResolver;

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


    'query1' => '
    
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

    'query2' => '
    
        query {
           invoice10: invoice(id: "10") {
            title
           }
           invoice9: invoice(id: "9") {
            title
           }
        }
        
    ',
    'variables' => []
];

$resolver = new ChainedRequirementResolver([
    $documentResolver = new DocumentRequirementResolver(),
    new DocumentInvoiceRequirementResolver($documentResolver)
]);

$context = new Context($resolver);
//$result = GraphQL::execute($schema, $input['query'], null, $context, $input['variables']);
$result = GraphQL::execute($schema, $input['query2'], null, $context, $input['variables']);

var_dump($result);