<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 13/08/2015
 * Time: 10:14
 */

namespace Cib\Bundle\LicenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Client
 * @package Cib\Bundle\LicenseBundle\Entity
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="Cib\Bundle\LicenseBundle\Entity\ClientRepository")
 */
class Client
{

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $clientId;

    /**
     * @ORM\Column(name="client_name", type="string", nullable=true)
     */
    private $clientName;

    /**
     * @ORM\Column(name="client_mail", type="string", nullable=true)
     */
    private $clientMail;

    /**
     * @ORM\Column(name="client_code", type="string", nullable=true)
     */
    private $clientCode;

    /**
     * @ORM\OneToMany(targetEntity="Tpe", mappedBy="client")
     */
    private $tpe;

    /**
     * @ORM\OneToMany(targetEntity="TokenClient", mappedBy="client", cascade={"persist","remove"})
     */
    private $tokenClient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tpe = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set clientName
     *
     * @param string $clientName
     * @return Client
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string 
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set clientMail
     *
     * @param string $clientMail
     * @return Client
     */
    public function setClientMail($clientMail)
    {
        $this->clientMail = $clientMail;

        return $this;
    }

    /**
     * Get clientMail
     *
     * @return string 
     */
    public function getClientMail()
    {
        return $this->clientMail;
    }

    /**
     * Add tpe
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\Tpe $tpe
     * @return Client
     */
    public function addTpe(\Cib\Bundle\LicenseBundle\Entity\Tpe $tpe)
    {
        $this->tpe[] = $tpe;

        return $this;
    }

    /**
     * Remove tpe
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\Tpe $tpe
     */
    public function removeTpe(\Cib\Bundle\LicenseBundle\Entity\Tpe $tpe)
    {
        $this->tpe->removeElement($tpe);
    }

    /**
     * Get tpe
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTpe()
    {
        return $this->tpe;
    }

    /**
     * Set clientCode
     *
     * @param string $clientCode
     * @return Client
     */
    public function setClientCode($clientCode)
    {
        $this->clientCode = $clientCode;

        return $this;
    }

    /**
     * Get clientCode
     *
     * @return string 
     */
    public function getClientCode()
    {
        return $this->clientCode;
    }


    /**
     * Add tokenClient
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\TokenClient $tokenClient
     * @return Client
     */
    public function addTokenClient(\Cib\Bundle\LicenseBundle\Entity\TokenClient $tokenClient)
    {
        $this->tokenClient[] = $tokenClient;
        $tokenClient->setClient($this);

        return $this;
    }

    /**
     * Remove tokenClient
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\TokenClient $tokenClient
     */
    public function removeTokenClient(\Cib\Bundle\LicenseBundle\Entity\TokenClient $tokenClient)
    {
        $this->tokenClient->removeElement($tokenClient);
    }

    /**
     * Get tokenClient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTokenClient()
    {
        return $this->tokenClient;
    }
}
