<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 24/08/2015
 * Time: 13:00
 */

namespace Cib\Bundle\SoapBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Csrf\CsrfTokenManager;

class sendKeyService
{

    private $entityManager;

    private $csrfTokenManager;

    public function __construct(EntityManager $entityManager,CsrfTokenManager $csrfTokenManager)
    {
        $this->entityManager = $entityManager;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    public function sendKey($szNumTpe)
    {

        $key = $this->entityManager->getRepository('CibSoapBundle:Key')->findOneBy(array('numTpe' => $szNumTpe));

//        if($key && $key->getClessKey())
//            $isCless = "1";
//        else
//            $isCless = "0";*/

        if($key)
            return[
                'cless' => $key->getClessKey(),
                'chip' => $key->getChipKey(),
            ];
        else
            return[
                'cless' => 'error',
                'chip' => 'error',
            ];
    }
}