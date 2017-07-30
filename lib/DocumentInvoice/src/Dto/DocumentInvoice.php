<?php

namespace Tg\DocumentInvoice\Dto;

use Tg\DocumentDomain\DocumentInterface;

class DocumentInvoice
{
    /** @var DocumentInterface */
    private $document;

    public function __construct(DocumentInterface $document)
    {
        $this->document = $document;
    }

    public function getDocumentInvoiceId()
    {
        return $this->document->getDocumentId();
    }

    public function getTitle()
    {
        return $this->document->getTitle();
    }

}