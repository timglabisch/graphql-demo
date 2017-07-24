<?php

namespace Tg\EasyGraphApi;

use Tg\EasyGraphApi\GraphType\Document\GraphTypeDocument;
use Tg\EasyGraphApi\GraphType\QueryGraphType;

class GraphTypeRegistry
{
    /** @var QueryGraphType */
    private $typeQuery;

    /** @var GraphTypeDocument */
    private $typeDocument;

    public function getTypeQuery()
    {
        return $this->typeQuery ?: ($this->typeQuery = new QueryGraphType($this));
    }

    public function getTypeDocument()
    {
        return $this->typeDocument ?: ($this->typeDocument = new GraphTypeDocument($this));
    }
}