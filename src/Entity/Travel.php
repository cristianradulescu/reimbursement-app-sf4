<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(name="travel", indexes={@ORM\Index(name="fk_travel_document_id", columns={"document_id"}), @ORM\Index(name="fk_travel_employee_id", columns={"employee_id"}), @ORM\Index(name="fk_travel_purpose_id", columns={"purpose_id"}), @ORM\Index(name="fk_travel_destination_id", columns={"destination_id"})})
 * @ORM\Entity
 */
class Travel
{
    const TRAVEL_ALLOWANCE = 32.5;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_start", type="date", nullable=false)
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=false)
     */
    private $dateEnd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_leave_time", type="datetime", nullable=false)
     */
    private $departureLeaveTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_arrival_time", type="datetime", nullable=false)
     */
    private $departureArrivalTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="destination_arrival_time", type="datetime", nullable=false)
     */
    private $destinationArrivalTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="destination_leave_time", type="datetime", nullable=false)
     */
    private $destinationLeaveTime;

    /**
     * @var \TravelDestination
     *
     * @ORM\ManyToOne(
     *     targetEntity="TravelDestination",
     *     fetch="EAGER"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="destination_id", referencedColumnName="id")
     * })
     */
    private $destination;

    /**
     * @var \Document
     *
     * @ORM\OneToOne(
     *     targetEntity="Document",
     *     inversedBy="travel"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     * })
     */
    private $document;

    /**
     * @var \Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * })
     */
    private $employee;

    /**
     * @var \TravelPurpose
     *
     * @ORM\ManyToOne(
     *     targetEntity="TravelPurpose",
     *     fetch="EAGER"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="purpose_id", referencedColumnName="id")
     * })
     */
    private $purpose;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt = 'CURRENT_TIMESTAMP';

    /**
     * Document constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Travel
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Travel
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set departureLeaveTime
     *
     * @param \DateTime $departureLeaveTime
     *
     * @return Travel
     */
    public function setDepartureLeaveTime($departureLeaveTime)
    {
        $this->departureLeaveTime = $departureLeaveTime;

        return $this;
    }

    /**
     * Get departureLeaveTime
     *
     * @return \DateTime
     */
    public function getDepartureLeaveTime()
    {
        return $this->departureLeaveTime;
    }

    /**
     * Set departureArrivalTime
     *
     * @param \DateTime $departureArrivalTime
     *
     * @return Travel
     */
    public function setDepartureArrivalTime($departureArrivalTime)
    {
        $this->departureArrivalTime = $departureArrivalTime;

        return $this;
    }

    /**
     * Get departureArrivalTime
     *
     * @return \DateTime
     */
    public function getDepartureArrivalTime()
    {
        return $this->departureArrivalTime;
    }

    /**
     * Set destinationArrivalTime
     *
     * @param \DateTime $destinationArrivalTime
     *
     * @return Travel
     */
    public function setDestinationArrivalTime($destinationArrivalTime)
    {
        $this->destinationArrivalTime = $destinationArrivalTime;

        return $this;
    }

    /**
     * Get destinationArrivalTime
     *
     * @return \DateTime
     */
    public function getDestinationArrivalTime()
    {
        return $this->destinationArrivalTime;
    }

    /**
     * Set destinationLeaveTime
     *
     * @param \DateTime $destinationLeaveTime
     *
     * @return Travel
     */
    public function setDestinationLeaveTime($destinationLeaveTime)
    {
        $this->destinationLeaveTime = $destinationLeaveTime;

        return $this;
    }

    /**
     * Get destinationLeaveTime
     *
     * @return \DateTime
     */
    public function getDestinationLeaveTime()
    {
        return $this->destinationLeaveTime;
    }

    /**
     * Set destination
     *
     * @param \App\Entity\TravelDestination $destination
     *
     * @return Travel
     */
    public function setDestination(\App\Entity\TravelDestination $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \App\Entity\TravelDestination
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set document
     *
     * @param \App\Entity\Document $document
     *
     * @return Travel
     */
    public function setDocument(\App\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \App\Entity\Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set employee
     *
     * @param \App\Entity\Employee $employee
     *
     * @return Travel
     */
    public function setEmployee(\App\Entity\Employee $employee = null)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \App\Entity\Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set purpose
     *
     * @param \App\Entity\TravelPurpose $purpose
     *
     * @return Travel
     */
    public function setPurpose(\App\Entity\TravelPurpose $purpose = null)
    {
        $this->purpose = $purpose;

        return $this;
    }

    /**
     * Get purpose
     *
     * @return \App\Entity\TravelPurpose
     */
    public function getPurpose()
    {
        return $this->purpose;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Travel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Travel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get the status via associated document.
     *
     * If the travel is not yet associated with a document, will return an empty status.
     *
     * @return Status
     */
    public function getStatus()
    {
        return $this->getDocument()
            ? $this->getDocument()->getStatus()
            : new DocumentStatus();
    }

    /**
     * @return int
     */
    public function getNumberOfDaysOnTravel()
    {
        return (int) $this->getDateEnd()->diff($this->getDateStart())->days + 1;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getEmployee().' - '.$this->getPurpose()
            .' ('.$this->getDateStart()->format('d M Y')
            .' / '.$this->getDateEnd()->format('d M Y').')';
    }
}
