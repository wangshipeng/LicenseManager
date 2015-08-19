<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 18/08/2015
 * Time: 09:01
 */

namespace Cib\Bundle\SoapBundle\Services;


use Cib\Bundle\LicenseBundle\Entity\TokenClient;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

class sendClientCodeService
{

    private $entityManager;

    private $csrfTokenManager;

    public function __construct(EntityManager $entityManager,CsrfTokenManager $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function sendClientCode($clientCode)
    {
        if($clientCode)
            $client = $this->entityManager->getRepository('CibLicenseBundle:Client')
                ->findOneBy(array('clientCode' => $clientCode));
        else
            return[
                'status' => 1,
                'clientName' => 'client code null',
                'clientToken' => " ",
                'clientId' => " ",
            ];

        $dateValidityToken = new \DateTime();
        $error = null;
        if($client){
            $tempCsrfToken = $this->csrfTokenManager->getToken($client->getClientId().$dateValidityToken->format('Y-m-d:h'));
            $csrfToken = $this->csrfTokenManager->getToken($tempCsrfToken->getValue());
            $tokenClient = new TokenClient($csrfToken->getId(),$csrfToken->getValue(),$client);
//            $tokenClient->setClient($client);
            $client->addTokenClient($tokenClient);
            $this->entityManager->persist($client);
//            $this->entityManager->persist($client);
            $this->entityManager->flush();

            $this->csrfTokenManager->removeToken($client->getClientId().$dateValidityToken->format('Y-m-d:h'));
            return[
                'status' => 0,
                'clientName' => $client->getClientName(),
                'clientToken' => $csrfToken->getId(),
                'clientId' => $client->getClientId(),
            ];
        }
        else{
            return[
                'status' => 1,
                'clientName' => $error,
                'clientToken' => " ",
                'clientId' => " ",
            ];
        }
    }


}