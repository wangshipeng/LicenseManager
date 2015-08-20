<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 13/08/2015
 * Time: 14:17
 */

namespace Cib\Bundle\SoapBundle\Services;


use Cib\Bundle\LicenseBundle\Entity\Client;
use Cib\Bundle\LicenseBundle\Entity\Software;
use Cib\Bundle\LicenseBundle\Entity\Tpe;
use Cib\Bundle\LicenseBundle\Entity\TpeSoftware;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

class sendLicenseService
{


    private $entityManager;

    private $csrfTokenManager;

    public function __construct(EntityManager $entityManager,CsrfTokenManager $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function sendLicense($numTpe,$infoSup0,$infoSup1,$infoSup2, $version, $crc, $typeTpe, $isCless, $isBt, $isGprs, $isWifi
        , $idClient, $tokenId, $numLicense)
    {


        $client = $this->entityManager->getRepository('CibLicenseBundle:Client')
            ->find($idClient);
        if(!$client)
            return [
                'status' => 9,
                'numLicense' => "Client inconuu",
                'softwareName' => "",
            ];

        if($this->findToken($client,$tokenId) != true)
            return [
                'status' => 8,
                'numLicense' => "Non authorise",
                'softwareName' => "",
            ];


        $softwareVersion = substr($version,6,4);
        $softwareNumber = substr($version,0, 6);

        $software = $this->entityManager->getRepository('CibLicenseBundle:Software')
            ->findOneBy(array('softwareNumber' => $softwareNumber));
        if(!$software)
            return [
                'status' => 7,
                'numLicense' => "Numero de logiciel incorrect",
                'softwareName' => "",
            ];

        $tpe = $this->entityManager->getRepository('CibLicenseBundle:Tpe')->findOneBy(array('tpeSerialNumber' => $numTpe,'tpeIsActive' => true));
        if($tpe && $tpe->getClient() != $client)
        {
            $tpe->setTpeIsActive(false);
            $tpe = new Tpe();
            $tpe->setClient($client);
        }
        if(!$tpe){
            $tpe = new Tpe();
            $tpe->setClient($client);
        }

        if($tpe->getClient() == $client && (($findTpeSoftware = $this->findSoftwareForOneTpe($tpe,$software,$numLicense)) != false)){
            $tpeSoftware = $findTpeSoftware;
            $tpeSoftware->setSoftwareDateMaj(new \DateTime());
        }
        else{
            if($numLicense != 0)
                return [
                    'status' => 6,
                    'numLicense' => "Numero de license incorrect",
                    'softwareName' => "",
                ];
            $tpeSoftware = new TpeSoftware();
            $tpeSoftware->setSoftwareDateInit(new \DateTime());
            $tpeSoftware->setSoftwareLicenseNumber($this->generateLicenseNumber());
        }

        $tpeSoftware->setSoftware($software);
        $tpeSoftware->setTpe($tpe);
        $tpeSoftware->setTpeSoftwareVersion($softwareVersion);
        $tpeSoftware->setSoftwareCrc($crc);

        $software->addTpeSoftware($tpeSoftware);
        $tpe->addTpeSoftware($tpeSoftware);
        $tpe->setInfoSup0($infoSup0);
        $tpe->setInfoSup1($infoSup1);
        $tpe->setInfoSup2($infoSup2);
        $tpe->setTpeIsActive(true);
        $tpe->setTpeIsBt($isBt);
        $tpe->setTpeIsCless($isCless);
        $tpe->setTpeIsGprs($isGprs);
        $tpe->setTpeIsWifi($isWifi);
        $tpe->setTpeType($typeTpe);
        $tpe->setTpeSerialNumber($numTpe);
        $this->entityManager->persist($tpe);
        $this->entityManager->persist($tpeSoftware);
        $this->entityManager->persist($software);

        try {
            $this->entityManager->flush();
            return [
                'status' => 0,
                'numLicense' => $tpeSoftware->getSoftwareLicenseNumber(),
                'softwareName' => $software->getSoftwareName(),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 1,
                'numLicense' => $e->getMessage(),
                'softwareName' => "",
            ];
        }


    }


    private function findToken(Client $client, $search)
    {
        $date = new \DateTime();

        foreach($client->getTokenClient() as $tokenClient){
            if($tokenClient->getTokenId() == $search){
                if($tokenClient->getTokenDate()->diff($date)->h < 1 ){
                    $client->removeTokenClient($tokenClient);
                    $this->entityManager->remove($tokenClient);
                    $this->entityManager->flush();
                    return true;
                }
                else{
                    $client->removeTokenClient($tokenClient);
                    $this->entityManager->remove($tokenClient);
                    $this->entityManager->flush();
                    return false;
                }
            }
        }
        return false;
    }

    private function findSoftwareForOneTpe(Tpe $tpe, Software $software, $numLicense)
    {
        foreach ($tpe->getTpeSoftware() as $tpeSoftware){
            if($tpeSoftware->getSoftware() == $software && $tpeSoftware->getSoftwareLicenseNumber() == $numLicense)
                return $tpeSoftware;
        }
        return false;

    }

    private function generateLicenseNumber()
    {
        $tempNumber = mt_rand(1,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
        while($this->entityManager->getRepository('CibLicenseBundle:TpeSoftware')->findOneBy(array(
            'softwareLicenseNumber'=> $tempNumber,
        )))
            $tempNumber = mt_rand(1,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);

        return $tempNumber;
    }
}