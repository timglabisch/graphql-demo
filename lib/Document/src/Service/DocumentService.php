<?php

namespace Tg\Document\Service;

use Tg\Document\Requirement\DocumentRequirement;
use Tg\DocumentDomain\DocumentInterface;
use Tg\DocumentDomain\DocumentReferenceInterface;
use Tg\DocumentDomain\Service\DocumentServiceInterface;

class DocumentService implements DocumentServiceInterface
{
    /** @var DocumentRequirementResolver */
    private $documentRequirementResolver;

    public function __construct(DocumentRequirementResolver $documentRequirementResolver)
    {
        $this->documentRequirementResolver = $documentRequirementResolver;
    }

    public function getDocument(DocumentReferenceInterface $documentReference): DocumentInterface
    {
        return $this->documentRequirementResolver->resolveAndReturn(new DocumentRequirement($documentReference));
    }

}