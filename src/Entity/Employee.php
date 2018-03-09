<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employee", uniqueConstraints={@ORM\UniqueConstraint(name="personal_numeric_code_UNIQUE", columns={"personal_numeric_code"}), @ORM\UniqueConstraint(name="identity_card_number_UNIQUE", columns={"identity_card_number"}), @ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"})}, indexes={@ORM\Index(name="fk_employee_job_title_id", columns={"job_title_id"}), @ORM\Index(name="fk_employee_division_manager_id", columns={"division_manager_id"}), @ORM\Index(name="fk_employee_company_id", columns={"company_id"})})
 * @ORM\Entity
 */
class Employee
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
     * @ORM\Column(name="first_name", type="string", length=45, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=true)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var integer
     *
     * @ORM\Column(name="personal_numeric_code", type="bigint", nullable=false)
     */
    private $personalNumericCode;

    /**
     * @var string
     *
     * @ORM\Column(name="identity_card_number", type="string", length=9, nullable=false)
     */
    private $identityCardNumber;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;

    /**
     * @var Employee
     *
     * @ORM\ManyToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="division_manager_id", referencedColumnName="id")
     * })
     */
    private $divisionManager;

    /**
     * @var EmployeeJobTitle
     *
     * @ORM\ManyToOne(targetEntity="EmployeeJobTitle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="job_title_id", referencedColumnName="id")
     * })
     */
    private $jobTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt = '';

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Employee
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Employee
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Employee
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Employee
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set personalNumericCode
     *
     * @param integer $personalNumericCode
     *
     * @return Employee
     */
    public function setPersonalNumericCode($personalNumericCode)
    {
        $this->personalNumericCode = $personalNumericCode;

        return $this;
    }

    /**
     * Get personalNumericCode
     *
     * @return integer
     */
    public function getPersonalNumericCode()
    {
        return $this->personalNumericCode;
    }

    /**
     * Set identityCardNumber
     *
     * @param string $identityCardNumber
     *
     * @return Employee
     */
    public function setIdentityCardNumber($identityCardNumber)
    {
        $this->identityCardNumber = $identityCardNumber;

        return $this;
    }

    /**
     * Get identityCardNumber
     *
     * @return string
     */
    public function getIdentityCardNumber()
    {
        return $this->identityCardNumber;
    }

    /**
     * Set company
     *
     * @param Company $company
     *
     * @return Employee
     */
    public function setCompany(Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set divisionManager
     *
     * @param Employee $divisionManager
     *
     * @return Employee
     */
    public function setDivisionManager(Employee $divisionManager = null)
    {
        $this->divisionManager = $divisionManager;

        return $this;
    }

    /**
     * Get divisionManager
     *
     * @return Employee
     */
    public function getDivisionManager()
    {
        return $this->divisionManager;
    }

    /**
     * Set jobTitle
     *
     * @param EmployeeJobTitle $jobTitle
     *
     * @return Employee
     */
    public function setJobTitle(EmployeeJobTitle $jobTitle = null)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return EmployeeJobTitle
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Employee
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Employee
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Get full employee name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->lastName.' '.$this->firstName;
    }

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getFullName();
    }
}
