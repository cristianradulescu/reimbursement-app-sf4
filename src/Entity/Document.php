<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Document
 *
 * @ORM\Table(name="document", indexes={@ORM\Index(name="fk_document_employee_id", columns={"employee_id"}), @ORM\Index(name="fk_document_status_id", columns={"status_id"}), @ORM\Index(name="fk_document_type_id", columns={"type_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document
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
     * @var \Employee
     *
     * @ORM\ManyToOne(
     *     targetEntity="Employee",
     *     fetch="EAGER"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     * })
     */
    private $employee;

    /**
     * @var \DocumentStatus
     *
     * @ORM\ManyToOne(
     *     targetEntity="DocumentStatus",
     *     fetch="EAGER"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     * })
     */
    private $status;

    /**
     * @var \DocumentType
     *
     * @ORM\ManyToOne(
     *     targetEntity="DocumentType",
     *     fetch="EAGER"
     * )
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var \Travel
     *
     * @ORM\OneToOne(
     *     targetEntity="Travel",
     *     mappedBy="document",
     *     cascade={"persist"},
     *     fetch="EAGER"
     * )
     */
    private $travel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(
     *     targetEntity="Reimbursement",
     *     mappedBy="document",
     *     cascade={"persist"},
     *     fetch="EAGER"
     * )
     */
    private $reimbursements;

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
        $this->reimbursements = new ArrayCollection();
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
     * Set employee
     *
     * @param \Employee $employee
     *
     * @return Document
     */
    public function setEmployee(\Employee $employee = null)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * Set status
     *
     * @param \DocumentStatus $status
     *
     * @return Document
     */
    public function setStatus(\DocumentStatus $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \DocumentStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set type
     *
     * @param \DocumentType $type
     *
     * @return Document
     */
    public function setType(\DocumentType $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \DocumentType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get reimbursement
     *
     * @return Collection
     */
    public function getReimbursements()
    {
        return $this->reimbursements;
    }

    /**
     * Get travel
     *
     * @return \Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Document
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
     * @return Document
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
     * @return bool
     */
    public function isTravel()
    {
        return DocumentType::TYPE_TRAVEL === $this->getType()->getId();
    }
    /**
     * @return bool
     */
    public function isReimbursement()
    {
        return DocumentType::TYPE_REIMBURSEMENT === $this->getType()->getId();
    }

    /**
     * @return bool
     */
    public function hasTravel()
    {
        return null !== $this->getTravel();
    }

    /**
     * @return float
     */
    public function getTotalAmount()
    {
        $total = 0;
        if ($this->isReimbursement()) {
            foreach ($this->getReimbursements() as $reimbursement) {
                $total += $reimbursement->getValue();
            }

            return round($total, 2);
        }

        if ($this->isTravel() && $this->hasTravel()) {
            return round($this->getTravel()->getNumberOfDaysOnTravel() * Travel::TRAVEL_ALLOWANCE, 2);
        }

        return $total;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $representation = $this->getType().' - '.$this->getEmployee();
        if ($this->isTravel() && $this->hasTravel()) {
            return  $representation.', '.$this->getTravel()->getDateStart()->format('d M Y');
        }

        return $representation;
    }
}
