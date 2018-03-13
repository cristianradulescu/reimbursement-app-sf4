<?php

namespace App\Service;

use App\Entity\Document;

/**
 * Class DocumentService
 * @package App\Service
 */
class DocumentPrintService
{
    protected $document;
    protected $documentType;

    /**
     * @param Document $document
     */
    public function setDocument(Document $document)
    {
        $this->document = $document;
        $this->documentType = $document->getType()->getName();
    }

    /**
     * @return string
     */
    public function getSvgTemplateName()
    {
        return $this->documentType.'_document.svg.twig';
    }

    /**
     * @return array
     */
    public function fillPlaceholders()
    {
        $factoryClass = "App\Service\\{$this->documentType}PlaceholderFactory";
        /** @var PlaceholderFactory $placeholderFactory */
        $placeholderFactory = new $factoryClass($this->document);

        return $placeholderFactory->fetchFilledPlaceholders();
    }
}