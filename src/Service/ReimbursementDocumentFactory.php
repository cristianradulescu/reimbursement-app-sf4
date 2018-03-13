<?php

namespace App\Service;


/**
 * Class ReimbursementDocumentFactory
 * @package App\Service
 */
class ReimbursementDocumentFactory extends DocumentFactory
{
    /**
     * @return array
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

    /**
     * @return array
     */
    public function generateExpensesReport()
    {
        $reimbursementsReport = array();
        $reimbursementReport = array();
        $reimbursementReport['employee'] = (string) $this->employee;

        /** @var Reimbursement $reimbursement */
        foreach ($this->document->getReimbursements() as $reimbursement) {
            $reimbursementReport['type'] = (string) $reimbursement->getType();
            $reimbursementReport['amount'] = (string) $reimbursement->getValue();
            $reimbursementsReport[] = $reimbursementReport;
        }

        return $reimbursementsReport;
    }
}