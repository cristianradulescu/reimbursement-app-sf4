<?php

namespace App\Service;

use App\Entity\Travel;

/**
 * Class TravelDocumentFactory
 * @package App\Service
 */
class TravelDocumentFactory extends DocumentFactory
{
    /**
     * @return array
     */
    public function fetchFilledPlaceholders()
    {
        /** @var Travel $travel */
        $travel = $this->document->getTravel();

        return [
            'PLACEHOLDER_COST_CENTER' => $this->company->getCostCenter(),
            'PLACEHOLDER_EMPLOYEE_NAME' => $this->employee->getFullName(),
            'PLACEHOLDER_EMPLOYEE_JOB_TITLE' => $this->employee->getJobTitle(),
            'PLACEHOLDER_TRAVEL_PURPOSE' => $travel->getPurpose(),
            'PLACEHOLDER_TRAVEL_DESTINATION' => $travel->getDestination(),
            'PLACEHOLDER_COMPANY_NAME' => $this->company->getName(),
            'PLACEHOLDER_EMPLOYEE_ICN' => $this->employee->getIdentityCardNumber(),
            'PLACEHOLDER_EMPLOYEE_PNC' => $this->employee->getPersonalNumericCode(),
            'PLACEHOLDER_DATE_FROM' => $travel->getDateStart(),
            'PLACEHOLDER_DATE_TO' => $travel->getDateEnd(),
            'PLACEHOLDER_DESTINATION_ARRIVAL_TIME' => $travel->getDestinationArrivalTime(),
            'PLACEHOLDER_DESTINATION_LEAVE_TIME' => $travel->getDestinationLeaveTime(),
            'PLACEHOLDER_STARTPOINT_LEAVE_TIME' => $travel->getDepartureLeaveTime(),
            'PLACEHOLDER_STARTPOINT_ARRIVAL_TIME' => $travel->getDepartureArrivalTime(),
            'PLACEHOLDER_MANAGER_LAST_NAME' => $this->company->getDivisionManager()->getLastName(),
            'PLACEHOLDER_MANAGER_FIRST_NAME' => $this->company->getDivisionManager()->getFirstName(),
            'PLACEHOLDER_EMPLOYEE_LAST_NAME' => $this->employee->getLastName(),
            'PLACEHOLDER_EMPLOYEE_FIRST_NAME' => $this->employee->getFirstName(),
            'PLACEHOLDER_TRAVEL_TOTAL_AMOUNT' => $this->document->getTotalAmount(),
            'PLACEHOLDER_DAYS_ON_TRAVEL' => $travel->getNumberOfDaysOnTravel(),
            'PLACEHOLDER_TRAVEL_ALLOWANCE' => $travel::TRAVEL_ALLOWANCE
        ];
    }

    /**
     * @return array
     */
    public function generateExpensesReport()
    {
        $travelReport = array();
        $travelReport['employee'] = (string) $this->employee;

        /** @var Travel $travel */
        $travel = $this->document->getTravel();
        $travelReport['type'] = "Diurna {$travel->getNumberOfDaysOnTravel()} zile";
        $travelReport['amount'] = Travel::TRAVEL_ALLOWANCE * $travel->getNumberOfDaysOnTravel();

        return array($travelReport);
    }
}