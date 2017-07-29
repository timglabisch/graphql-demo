<?php

namespace Tg\DocumentDomain;

class DocumentReference implements DocumentReferenceInterface
{
    private $documentId;

    public function __construct($documentId)
    {
        $this->documentId = $documentId;
    }

    public function getDocumentId()
    {
        return $this->documentId;
    }

}