<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 13/08/2015
 * Time: 10:17
 */

namespace Cib\Bundle\LicenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Software
 * @package Cib\Bundle\LicenseBundle\Software
 *
 * @ORM\Table(name="software")
 * @ORM\Entity(repositoryClass="Cib\Bundle\LicenseBundle\Entity\SoftwareRepository")
 */
class Software
{

    /**
     * @var integer
     *
     * @ORM\Column(name="software_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $softwareId;

    /**
     * @ORM\Column(name="software_name", type="string")
     */
    private $softwareName;

    /**
     * @ORM\Column(name="software_number", type="string")
     */
    private $softwareNumber;


    /**
     * @ORM\OneToMany(targetEntity="TpeSoftware", mappedBy="software")
     **/
    private $tpeSoftware;

    /**
     * Get softwareId
     *
     * @return integer 
     */
    public function getSoftwareId()
    {
        return $this->softwareId;
    }

    /**
     * Set softwareName
     *
     * @param string $softwareName
     * @return Software
     */
    public function setSoftwareName($softwareName)
    {
        $this->softwareName = $softwareName;

        return $this;
    }

    /**
     * Get softwareName
     *
     * @return string 
     */
    public function getSoftwareName()
    {
        return $this->softwareName;
    }

    /**
     * Set softwareNumber
     *
     * @param string $softwareNumber
     * @return Software
     */
    public function setSoftwareNumber($softwareNumber)
    {
        $this->softwareNumber = $softwareNumber;

        return $this;
    }

    /**
     * Get softwareNumber
     *
     * @return string 
     */
    public function getSoftwareNumber()
    {
        return $this->softwareNumber;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tpeSoftware = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tpeSoftware
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\TpeSoftware $tpeSoftware
     * @return Software
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
}
