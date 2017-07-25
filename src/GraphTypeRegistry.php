<?php

namespace Tg\EasyGraphApi;

use Tg\EasyGraphApi\GraphType\Document\CreateDocumentMutationType;
use Tg\EasyGraphApi\GraphType\Document\GraphTypeDocument;
use Tg\EasyGraphApi\GraphType\MutationGraphType;
use Tg\EasyGraphApi\GraphType\QueryGraphType;

class GraphTypeRegistry
{
    /** @var QueryGraphType */
    private $typeQuery;

    /** @var GraphTypeDocument */
    private $typeDocument;

    private $documentMutationType;

    private $mutationType;

    public function getTypeQuery()
    {
        return $this->typeQuery ?: ($this->typeQuery = new QueryGraphType($this));
    }

    public function getMutationType()
    {
        return $this->mutationType ?: ($this->mutationType = new MutationGraphType($this));
    }

    public function getTypeDocument()
    {
        return $this->typeDocument ?: ($this->typeDocument = new GraphTypeDocument($this));
    }

    public function getDocumentMutationType()
    {
        return $this->documentMutationType ?: ($this->documentMutationType = new CreateDocumentMutationType($this));
    }
}