<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 18/08/2015
 * Time: 12:04
 */

namespace Cib\Bundle\LicenseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TokenClient
 * @package Cib\Bundle\LicenseBundle\Entity
 *
 * @ORM\Table(name="tokenClient")
 * @ORM\Entity(repositoryClass="Cib\Bundle\LicenseBundle\Entity\TokenClientRepository")
 */
class TokenClient
{

    /**
     * @var integer
     *
     * @ORM\Column(name="token_client_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $tokenClientId;

    /**
     * @ORM\Column(name="token_id", type="string")
     */
    private $tokenId;

    /**
     * @ORM\Column(name="token_value", type="string")
     */
    private $tokenValue;

    /**
     * @ORM\Column(name="token_date", type="datetime")
     */
    private $tokenDate;

    /**
     * @ORM\ManyToOne(targetEntity="Client", cascade="persist")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="client_id")
     */
    private $client;

    public function __construct($tokenId = null, $tokenValue= null,Client $client = null)
    {
        $this->tokenDate = new \DateTime();
        $this->tokenId = $tokenId;
        $this->tokenValue = $tokenValue;
        $this->client = $client;
    }

    /**
     * Get tokenClientId
     *
     * @return integer 
     */
    public function getTokenClientId()
    {
        return $this->tokenClientId;
    }

    /**
     * Set tokenId
     *
     * @param string $tokenId
     * @return TokenClient
     */
    public function setTokenId($tokenId)
    {
        $this->tokenId = $tokenId;

        return $this;
    }

    /**
     * Get tokenId
     *
     * @return string 
     */
    public function getTokenId()
    {
        return $this->tokenId;
    }

    /**
     * Set tokenValue
     *
     * @param string $tokenValue
     * @return TokenClient
     */
    public function setTokenValue($tokenValue)
    {
        $this->tokenValue = $tokenValue;

        return $this;
    }

    /**
     * Get tokenValue
     *
     * @return string 
     */
    public function getTokenValue()
    {
        return $this->tokenValue;
    }

    /**
     * Set tokenDate
     *
     * @param \DateTime $tokenDate
     * @return TokenClient
     */
    public function setTokenDate($tokenDate)
    {
        $this->tokenDate = $tokenDate;

        return $this;
    }

    /**
     * Get tokenDate
     *
     * @return \DateTime 
     */
    public function getTokenDate()
    {
        return $this->tokenDate;
    }

    /**
     * Set client
     *
     * @param \Cib\Bundle\LicenseBundle\Entity\Client $client
     * @return TokenClient
     */
    public function setClient(\Cib\Bundle\LicenseBundle\Entity\Client $client = null)
    {
        $this->client = $client;
//        $client->addTokenClient($this);

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
}
