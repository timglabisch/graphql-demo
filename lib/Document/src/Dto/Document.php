<?php

namespace Tg\Document\Dto;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Tg\DocumentDomain\DocumentInterface;

class Document implements DocumentInterface
{
    private $documentId;

    private $title;

    private $documentType;

    public static function fromArray(array $data)
    {
        $data = (new OptionsResolver())->setDefaults([
            'document_id' => null,
            'document_type' => null,
            'title' => null
        ])->resolve($data);

        $self = new self();
        $self->documentId = $data['document_id'];
        $self->documentType = $data['document_type'];
        $self->title = $data['title'];

        return $self;
    }

    private function __construct()
    {

    }

    public function getDocumentId()
    {
        return $this->documentId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDocumentType()
    {
        return $this->documentType;
    }

}