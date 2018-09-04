<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contract
 *
 * @ORM\Table(name="obj_contracts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContractRepository")
 */
class Contract
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_contract", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="contracts")
     * @ORM\JoinColumn(name="id_customer", referencedColumnName="id_customer")
     */
    private $customer;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=100)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_sign", type="date")
     */
    private $dateSign;

    /**
     * @var string
     *
     * @ORM\Column(name="staff_number", type="string", length=100)
     */
    private $staffNumber;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Service", mappedBy="contract")
     */
    private $services;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set customer
     *
     * @param Customer $customer
     *
     * @return Contract
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Contract
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
     * Set dateSign
     *
     * @param \DateTime $dateSign
     *
     * @return Contract
     */
    public function setDateSign($dateSign)
    {
        $this->dateSign = $dateSign;

        return $this;
    }

    /**
     * Get dateSign
     *
     * @return \DateTime
     */
    public function getDateSign()
    {
        return $this->dateSign;
    }

    /**
     * Set staffNumber
     *
     * @param string $staffNumber
     *
     * @return Contract
     */
    public function setStaffNumber($staffNumber)
    {
        $this->staffNumber = $staffNumber;

        return $this;
    }

    /**
     * Get staffNumber
     *
     * @return string
     */
    public function getStaffNumber()
    {
        return $this->staffNumber;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add service
     *
     * @param \AppBundle\Entity\Service $service
     *
     * @return Contract
     */
    public function addService(\AppBundle\Entity\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \AppBundle\Entity\Service $service
     */
    public function removeService(\AppBundle\Entity\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}
