<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 18/08/2015
 * Time: 09:01
 */

namespace Cib\Bundle\SoapBundle\Services;


use Doctrine\ORM\EntityManager;

class sendClientCodeService
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function sendClientCode($clientCode)
    {
        $client = $this->entityManager->getRepository('CibLicenseBundle:Client')
            ->findOneBy(array('clientCode' => $clientCode));

        if($client){
            return[
                'status' => 0,
                'clientName' => $client->getClientName,
            ];
        }
        else{
            return[
                'status' => 1,
                'clientName' => " ",
            ];
        }
    }


}