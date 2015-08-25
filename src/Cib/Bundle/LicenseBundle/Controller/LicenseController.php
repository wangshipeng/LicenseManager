<?php

namespace Cib\Bundle\LicenseBundle\Controller;

use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LicenseController extends Controller
{
    /**
     * @Route("/display/licenses", name="displayGlobalLicenses")
     * @Template()
     */
    public function displayGlobalLicensesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clientRepository = $em->getRepository('CibLicenseBundle:Client');

        $clients = $clientRepository->findAll();

        return[
            'clients' => $clients,
        ];
    }

    /**
     * @param Request $request
     * @param $clientId
     *
     * @Route("/get/tpe/from/client/{clientId}", name="getTpeFromClient", options={"expose"=true})
     * @return \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function getTpeFromClientAction(Request $request,$clientId)
    {
        if($request->isXmlHttpRequest() && $request->isMethod('POST'))
        {
            $em = $this->getDoctrine()->getManager();
            $serializer = new SerializerBuilder();

            $clientRepository = $em->getRepository('CibLicenseBundle:Client');
            $client = $clientRepository->find($clientId);

            return new Response($serializer->create()->build()->serialize($client->getTpe(),'json'),200);
        }
        else
            return $this->createNotFoundException('DANS TON CUL !');




    }
}
