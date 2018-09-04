<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="obj_services")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ServiceRepository")
 */
class Service
{
    public static $serviceStatuses = [
        'work'=>'work',
        'connecting'=>'connecting',
        'disconnected'=>'disconnected',
    ];

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contract", inversedBy="services")
     * @ORM\JoinColumn(name="id_contract", referencedColumnName="id_contract")
     */
    private $contract;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", columnDefinition="enum('work', 'connecting', 'disconnected')"))
     */
    private $status;


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
     * Set contract
     *
     * @param Contract $contract
     *
     * @return Service
     */
    public function setContract($contract)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return Contract
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Service
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Service
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
