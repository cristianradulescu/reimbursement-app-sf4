<?php

namespace App\Service;


/**
 * Class ReimbursementPlaceholderFactory
 * @package App\Service
 */
class ReimbursementPlaceholderFactory extends PlaceholderFactory
{
    /*
     *
     */
    public function fetchFilledPlaceholders()
    {
        return [
            'PLACEHOLDER_COMPANY_NAME' => $this->company->getName(),
            'PLACEHOLDER_COST_CENTER' => $this->company->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->employee->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->employee->getJobTitle(),
            'PLACEHOLDER_DIVISION_MANAGER_LAST_NAME' => $this->company->getDivisionManager()->getLastName(),
            'PLACEHOLDER_DIVISION_MANAGER_FIRST_NAME' => $this->company->getDivisionManager()->getFirstName(),
            'PLACEHOLDER_REIMBURSEMENT_TOTAL_AMOUNT' => $this->document->getTotalAmount(),
            'reimbursement_collection' => $this->document->getReimbursements()
        ];
    }

}