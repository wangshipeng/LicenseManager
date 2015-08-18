<?php

namespace Cib\Bundle\SoapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class SoapController extends Controller
{
    /**
     * @Route("/soap/license")
     * @Template()
     */
    public function sendLicenseAction()
    {
//        $server = new \SoapServer($this->container->get('templating.helper.assets')->getUrl('cibsoap/soap/test.wsdl'));
        //$server = new \SoapServer('/var/www/LicenseManager/web/bundles/cibsoap/soap/licenseSoap.wsdl');
        $server = new \SoapServer('C:\wamp\www\LicenseManager\web\bundles\cibsoap\soap\licenseSoap.wsdl');
        $server->setObject($this->get('sendLicense'));

        $response = new Response();
        $response->headers->set('Content-Type','text/xml; charset=utf-8');

        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());
        return $response;
    }

    /**
     * @Route("/soap/client")
     * @Template()
     */
    public function sendClientCodeAction()
    {
//        $server = new \SoapServer($this->container->get('templating.helper.assets')->getUrl('cibsoap/soap/test.wsdl'));
//        $server = new \SoapServer('/var/www/LicenseManager/web/bundles/cibsoap/soap/licenseSoap.wsdl');
        $server = new \SoapServer('C:\wamp\www\LicenseManager\web\bundles\cibsoap\soap\licenseSoap.wsdl');
        $server->setObject($this->get('sendClientCode'));

        $response = new Response();
        $response->headers->set('Content-Type','text/xml; charset=utf-8');

        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());
        return $response;
    }
}
