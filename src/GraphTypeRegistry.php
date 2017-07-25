<?php

namespace Tg\EasyGraphApi;

use Tg\EasyGraphApi\Graph\Document\GraphMutationDocument;
use Tg\EasyGraphApi\Graph\Document\GraphQueryDocumentType;
use Tg\EasyGraphApi\Graph\Document\Type\Input\GraphNewDocumentInputType;
use Tg\EasyGraphApi\Graph\GraphMutationType;
use Tg\EasyGraphApi\Graph\GraphQueryType;

class GraphTypeRegistry
{
    /** @var GraphQueryType */
    private $typeQuery;

    /** @var GraphQueryDocumentType */
    private $typeDocument;

    private $documentMutationType;

    private $mutationType;

    private $documentMutation;

    public function getTypeQuery()
    {
        return $this->typeQuery ?: ($this->typeQuery = new GraphQueryType($this));
    }

    public function getMutationType()
    {
        return $this->mutationType ?: ($this->mutationType = new GraphMutationType($this));
    }

    public function getTypeDocument()
    {
        return $this->typeDocument ?: ($this->typeDocument = new GraphQueryDocumentType($this));
    }

    public function getDocumentMutationType()
    {
        return $this->documentMutationType ?: ($this->documentMutationType = new GraphNewDocumentInputType($this));
    }

    public function getDocumentMutation()
    {
        return $this->documentMutation ?: ($this->documentMutation = new GraphMutationDocument($this));
    }
}