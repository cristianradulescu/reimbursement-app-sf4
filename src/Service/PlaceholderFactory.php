<?php

namespace App\Service;

use App\Entity\Company;
use App\Entity\Document;
use App\Entity\Employee;

/**
 * Class PlaceholderFactory
 * @package App\Service
 */
abstract class PlaceholderFactory
{
    /**
     * @var Document
     */
    protected $document;

    /**
     * @var Employee
     */
    protected $employee;

    /**
     * @var Company
     */
    protected $company;

    public function __construct(Document $document)
    {
        $this->document = $document;
        $this->employee = $document->getEmployee();
        $this->company = $this->employee->getCompany();
    }

    /**
     * @return array
     */
    abstract function fetchFilledPlaceholders();
}