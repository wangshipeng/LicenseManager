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

class sendLicenseService
{


    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function sendLicense($numTpe,$infoSup0,$infoSup1,$infoSup2, $version, $crc, $typeTpe, $isCless, $isBt, $isGprs)
    {

        $tpe = new Tpe();
        //$software = new Software();
        $tpeSoftware = new TpeSoftware();
        $client = new Client();
        $softwareVersion = substr($version,6,4);
        $softwareNumber = substr($version,0, 6);

        $software = $this->entityManager->getRepository('CibLicenseBundle:Software')
            ->findOneBy(array('softwareNumber' => $softwareNumber));
        if(!$software)
            return 1;
        else{
            $tpeSoftware->setSoftware($software);
            $tpeSoftware->setTpe($tpe);
        }

        $tpeSoftware->setTpeSoftwareVersion($softwareVersion);
        $tpeSoftware->setSoftwareCrc($crc);
        //$tpeSoftware->setTpeSoftwareVersion($version);
        $tpeSoftware->setSoftwareDate(new \DateTime());

        $software->addTpeSoftware($tpeSoftware);
        $tpe->addTpeSoftware($tpeSoftware);
        $tpe->setInfoSup0($infoSup0);
        $tpe->setInfoSup1($infoSup1);
        $tpe->setInfoSup2($infoSup2);
        $tpe->setTpeIsActive(true);
        $tpe->setTpeIsBt($isBt);
        $tpe->setTpeIsCless($isCless);
        $tpe->setTpeIsGprs($isGprs);
        $tpe->setTpeType($typeTpe);
        $tpe->setTpeSerialNumber($numTpe);
        $tpe->setClient($client);
        $this->entityManager->persist($tpe);
        $this->entityManager->persist($tpeSoftware);
        $this->entityManager->persist($software);

        try {
            $this->entityManager->flush();
            return 0;
        } catch (\Exception $e) {
            return $e->getMessage();
        }


    }

}