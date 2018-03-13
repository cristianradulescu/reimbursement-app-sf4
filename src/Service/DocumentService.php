<?php

namespace App\Service;

use App\Entity\Document;

/**
 * Class DocumentService
 * @package App\Service
 */
class DocumentService
{
    protected $document;
    protected $documentType;

    /**
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->documentType = $document->getType()->getName();
    }

    /**
     * @return DocumentFactory
     */
    protected function getDocumentFactory()
    {
        $factoryClass = "App\Service\\{$this->documentType}DocumentFactory";

        /** @var DocumentFactory $placeholderFactory */
        return new $factoryClass($this->document);
    }

    /**
     * @return string
     */
    public function getSvgTemplateName()
    {
        return str_replace(' ', '_', $this->documentType).'_document.svg.twig';
    }

    /**
     * @return array
     */
    public function fillPlaceholders()
    {
        return $this->getDocumentFactory()->fetchFilledPlaceholders();
    }

    /**
     * @return mixed
     */
    public function generateExpensesReport()
    {
        return $this->getDocumentFactory()->generateExpensesReport();
    }
}