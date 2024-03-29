<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 24/08/2015
 * Time: 15:35
 */

namespace Cib\Bundle\SoapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Key
 * @package Cib\Bundle\LicenseBundle\Entity
 *
 * @ORM\Table(name="pscKey")
 * @ORM\Entity(repositoryClass="Cib\Bundle\SoapBundle\Entity\KeyRepository")
 */
class Key
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $keyId;

    /**
     * @ORM\Column(name="chip", type="string",nullable=true);
     */
    private $chipKey;

    /**
     * @ORM\Column(name="cless", type="string", nullable=true);
     */
    private $clessKey;

    /**
     * @ORM\Column(name="numTpe", type="string", nullable=true)
     */
    private $numTpe;

    /**
     * Get keyId
     *
     * @return integer 
     */
    public function getKeyId()
    {
        return $this->keyId;
    }


    /**
     * Set clessKey
     *
     * @param boolean $clessKey
     * @return Key
     */
    public function setClessKey($clessKey)
    {
        $this->clessKey = $clessKey;

        return $this;
    }

    /**
     * Get clessKey
     *
     * @return boolean 
     */
    public function getClessKey()
    {
        return $this->clessKey;
    }

    /**
     * Set numTpe
     *
     * @param string $numTpe
     * @return Key
     */
    public function setNumTpe($numTpe)
    {
        $this->numTpe = $numTpe;

        return $this;
    }

    /**
     * Get numTpe
     *
     * @return string 
     */
    public function getNumTpe()
    {
        return $this->numTpe;
    }

    /**
     * Set chipKey
     *
     * @param string $chipKey
     * @return Key
     */
    public function setChipKey($chipKey)
    {
        $this->chipKey = $chipKey;

        return $this;
    }

    /**
     * Get chipKey
     *
     * @return string 
     */
    public function getChipKey()
    {
        return $this->chipKey;
    }
}
