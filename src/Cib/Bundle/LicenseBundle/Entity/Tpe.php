<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 13/08/2015
 * Time: 10:16
 */

namespace Cib\Bundle\LicenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tpe
 * @package Cib\Bundle\LicenseBundle\Entity
 *
 * @ORM\Table(name="tpe")
 * @ORM\Entity(repositoryClass="Cib\Bundle\LicenseBundle\Entity\TpeRepository")
 */
class Tpe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tpe_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $tpeId;

    /**
     * @ORM\Column(name="tpe_serialNumber", type="string")
     */
    private $tpeSerialNumber;

    /**
     * @ORM\Column(name="tpe_type", type="string")
     */
    private $tpeType;

    /**
     * @ORM\Column(name="tpe_isCless", type="boolean")
     */
    private $tpeIsCless;

    /**
     * @ORM\Column(name="tpe_isBt", type="boolean")
     */
    private $tpeIsBt;

    /**
     * @ORM\Column(name="tpe_isGprs", type="boolean")
     */
    private $tpeIsGprs;

    /**
     * @ORM\Column(name="tpe_isActive", type="boolean")
     */
    private $tpeIsActive;

    /**
     * @ORM\Column(name="tpe_infoSup0", type="string")
     */
    private $infoSup0;

    /**
     * @ORM\Column(name="tpe_infoSup1", type="string")
     */
    private $infoSup1;

    /**
     * @ORM\Column(name="tpe_infoSup2", type="string")
     */
    private $infoSup2;


    /**
     * @ORM\OneToMany(targetEntity="TpeSoftware",mappedBy="tpe")
     */
    private $tpeSoftware;

    /**
     * @ORM\ManyToOne(targetEntity="Client", cascade="persist")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="client_id")
     */
    private $client;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tpeSoftware = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get tpeId
     *
     * @return integer 
     */
    public function getTpeId()
    {
        return $this->tpeId;
    }

    /**
     * Set tpeSerialNumber
     *
     * @param string $tpeSerialNumber
     * @return Tpe
     */
    public function setTpeSerialNumber($tpeSerialNumber)
    {
        $this->tpeSerialNumber = $tpeSerialNumber;

        return $this;
    }

    /**
     * Get tpeSerialNumber
     *
     * @return string 
     */
    public function getTpeSerialNumber()
    {
        return $this->tpeSerialNumber;
    }

    /**
     * Set tpeType
     *
     * @param string $tpeType
     * @return Tpe
     */
    public function setTpeType($tpeType)
    {
        $this->tpeType = $tpeType;

        return $this;
    }

    /**
     * Get tpeType
     *
     * @return string 
     */
    public function getTpeType()
    {
        return $this->tpeType;
    }

    /**
     * Set tpeIsCless
     *
     * @param boolean $tpeIsCless
     * @return Tpe
     */
    public function setTpeIsCless($tpeIsCless)
    {
        $this->tpeIsCless = $tpeIsCless;

        return $this;
    }

    /**
     * Get tpeIsCless
     *
     * @return boolean 
     */
    public function getTpeIsCless()
    {
        return $this->tpeIsCless;
    }

    /**
     * Set tpeIsBt
     *
     * @param boolean $tpeIsBt
     * @return Tpe
     */
    public function setTpeIsBt($tpeIsBt)
    {
        $this->tpeIsBt = $tpeIsBt;

        return $this;
    }

    /**
     * Get tpeIsBt
     *
     * @return boolean 
     */
    public function getTpeIsBt()
    {
        return $this->tpeIsBt;
    }

    /**
     * Set tpeIsGprs
     *
     * @param boolean $tpeIsGprs
     * @return Tpe
     */
    public function setTpeIsGprs($tpeIsGprs)
    {
        $this->tpeIsGprs = $tpeIsGprs;

        return $this;
    }

    /**
     * Get tpeIsGprs
     *
     * @return boolean 
     */
    public function getTpeIsGprs()
    {
        return $this->tpeIsGprs;
    }

    /**
     * Set tpeIsActive
     *
     * @param boolean $tpeIsActive
     * @return Tpe
     */
    public function setTpeIsActive($tpeIsActive)
    {
        $this->tpeIsActive = $tpeIsActive;

        return $this;
    }

    /**
     * Get tpeIsActive
     *
     * @return boolean 
     */
    public function getTpeIsActive()
    {
        return $this->tpeIsActive;
    }

    /**
     * Add tpeSoftware
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\TpeSoftware $tpeSoftware
     * @return Tpe
     */
    public function addTpeSoftware(\Cib\Bundle\LicenseBundle\Entity\TpeSoftware $tpeSoftware)
    {
        $this->tpeSoftware[] = $tpeSoftware;

        return $this;
    }

    /**
     * Remove tpeSoftware
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\TpeSoftware $tpeSoftware
     */
    public function removeTpeSoftware(\Cib\Bundle\LicenseBundle\Entity\TpeSoftware $tpeSoftware)
    {
        $this->tpeSoftware->removeElement($tpeSoftware);
    }

    /**
     * Get tpeSoftware
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTpeSoftware()
    {
        return $this->tpeSoftware;
    }

    /**
     * Set client
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\Client $client
     * @return Tpe
     */
    public function setClient(\Cib\Bundle\LicenseBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Cib\Bundle\LicenseBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set infoSup0
     *
     * @param string $infoSup0
     * @return Tpe
     */
    public function setInfoSup0($infoSup0)
    {
        $this->infoSup0 = $infoSup0;

        return $this;
    }

    /**
     * Get infoSup0
     *
     * @return string 
     */
    public function getInfoSup0()
    {
        return $this->infoSup0;
    }

    /**
     * Set infoSup1
     *
     * @param string $infoSup1
     * @return Tpe
     */
    public function setInfoSup1($infoSup1)
    {
        $this->infoSup1 = $infoSup1;

        return $this;
    }

    /**
     * Get infoSup1
     *
     * @return string 
     */
    public function getInfoSup1()
    {
        return $this->infoSup1;
    }

    /**
     * Set infoSup2
     *
     * @param string $infoSup2
     * @return Tpe
     */
    public function setInfoSup2($infoSup2)
    {
        $this->infoSup2 = $infoSup2;

        return $this;
    }

    /**
     * Get infoSup2
     *
     * @return string 
     */
    public function getInfoSup2()
    {
        return $this->infoSup2;
    }
}
