<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 18/08/2015
 * Time: 09:01
 */

namespace Cib\Bundle\SoapBundle\Services;


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
        $client = $this->entityManager->getRepository('CibLicenseBundle:Client')
            ->findOneBy(array('clientCode' => $clientCode));

        $dateValidityToken = new \DateTime();

        if($client){
            $csrfToken = $this->csrfTokenManager->getToken($client->getClientId.$dateValidityToken->format('Y-m-d:h'));

            return[
                'status' => 0,
                'clientName' => $client->getClientName(),
                'clientToken' => $csrfToken,
                'clientId' => $client->getClientId(),
            ];
        }
        else{
            return[
                'status' => 1,
                'clientName' => " ",
                'clientToken' => " ",
                'clientId' => " ",
            ];
        }
    }


}