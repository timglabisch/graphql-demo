<?php

namespace Tg\DocumentDomain\Service;

use Tg\DocumentDomain\DocumentInterface;
use Tg\DocumentDomain\DocumentReferenceInterface;

interface DocumentServiceInterface
{

    /** @return DocumentInterface|null */
    public function getDocument(DocumentReferenceInterface $documentReference);

}