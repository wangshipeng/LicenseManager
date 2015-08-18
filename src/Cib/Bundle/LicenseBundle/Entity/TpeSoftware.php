<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 17/08/2015
 * Time: 09:52
 */

namespace Cib\Bundle\LicenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class TpeSoftware
 * @package Cib\Bundle\LicenseBundle\Entity
 *
 * @ORM\Table(name="tpeSoftware")
 * @ORM\Entity(repositoryClass="Cib\Bundle\LicenseBundle\Entity\TpeSoftwareRepository")
 */
class TpeSoftware
{

    /**
     * @var integer
     *
     * @ORM\Column(name="tpe_software_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idTpeSoftware;

    /**
     * @ORM\Column(name="tpe_software_version", type="string")
     */
    private $tpeSoftwareVersion;

    /**
     * @ORM\Column(name="tpe_software_crc", type="string")
     */
    private $softwareCrc;

    /**
     * @ORM\Column(name="tpe_software_date", type="datetime")
     */
    private $softwareDate;

    /**
     * @ORM\ManyToOne(targetEntity="Tpe", inversedBy="tpeSoftware")
     * @ORM\JoinColumn(name="tpe_id", referencedColumnName="tpe_id")
     **/
    private $tpe;

    /**
     * @ORM\ManyToOne(targetEntity="Software", inversedBy="tpeSoftware")
     * @ORM\JoinColumn(name="software_id", referencedColumnName="software_id")
     **/
    private $software;


    /**
     * Get idTpeSoftware
     *
     * @return integer 
     */
    public function getIdTpeSoftware()
    {
        return $this->idTpeSoftware;
    }

    /**
     * Set tpeSoftwareVersion
     *
     * @param string $tpeSoftwareVersion
     * @return TpeSoftware
     */
    public function setTpeSoftwareVersion($tpeSoftwareVersion)
    {
        $this->tpeSoftwareVersion = $tpeSoftwareVersion;

        return $this;
    }

    /**
     * Get tpeSoftwareVersion
     *
     * @return string 
     */
    public function getTpeSoftwareVersion()
    {
        return $this->tpeSoftwareVersion;
    }

    /**
     * Set softwareCrc
     *
     * @param string $softwareCrc
     * @return TpeSoftware
     */
    public function setSoftwareCrc($softwareCrc)
    {
        $this->softwareCrc = $softwareCrc;

        return $this;
    }

    /**
     * Get softwareCrc
     *
     * @return string 
     */
    public function getSoftwareCrc()
    {
        return $this->softwareCrc;
    }

    /**
     * Set tpe
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\Tpe $tpe
     * @return TpeSoftware
     */
    public function setTpe(\Cib\Bundle\LicenseBundle\Entity\Tpe $tpe = null)
    {
        $this->tpe = $tpe;

        return $this;
    }

    /**
     * Get tpe
     *
     * @return \Cib\Bundle\LicenseBundle\Entity\Tpe 
     */
    public function getTpe()
    {
        return $this->tpe;
    }

    /**
     * Set software
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\Software $software
     * @return TpeSoftware
     */
    public function setSoftware(\Cib\Bundle\LicenseBundle\Entity\Software $software = null)
    {
        $this->software = $software;

        return $this;
    }

    /**
     * Get software
     *
     * @return \Cib\Bundle\LicenseBundle\Entity\Software 
     */
    public function getSoftware()
    {
        return $this->software;
    }

    /**
     * Set softwareDate
     *
     * @param \DateTime $softwareDate
     * @return TpeSoftware
     */
    public function setSoftwareDate($softwareDate)
    {
        $this->softwareDate = $softwareDate;

        return $this;
    }

    /**
     * Get softwareDate
     *
     * @return \DateTime 
     */
    public function getSoftwareDate()
    {
        return $this->softwareDate;
    }
}
