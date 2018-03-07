<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reimbursement
 *
 * @ORM\Table(name="reimbursement", indexes={@ORM\Index(name="fk_reimbursement_type_id", columns={"type_id"}), @ORM\Index(name="fk_reimbursement_employee_id", columns={"employee_id"}), @ORM\Index(name="fk_reimbursement_document_id", columns={"document_id"})})
 * @ORM\Entity
 */
class Reimbursement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=45, nullable=false)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $value;

    /**
     * @var \Document
     *
     * @ORM\ManyToOne(
     *     targetEntity="Document",
     *     inversedBy="reimbursements"
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
     * @var \ReimbursementType
     *
     * @ORM\ManyToOne(targetEntity="ReimbursementType")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

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
     * Set number
     *
     * @param string $number
     *
     * @return Reimbursement
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reimbursement
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set value
     *
     * @param string $value
     *
     * @return Reimbursement
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set document
     *
     * @param \App\Entity\Document $document
     *
     * @return Reimbursement
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
     * @return Reimbursement
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
     * Set type
     *
     * @param \App\Entity\ReimbursementType $type
     *
     * @return Reimbursement
     */
    public function setType(\App\Entity\ReimbursementType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \App\Entity\ReimbursementType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Reimbursement
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
     * @return Reimbursement
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
     * If the reimbursement is not yet associated with a document, will return an empty status.
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
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getType().' '.$this->getNumber().' / '.$this->getDate()->format('d-M-Y');
    }
}
