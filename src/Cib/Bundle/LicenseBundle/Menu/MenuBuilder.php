<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 20/08/2015
 * Time: 15:15
 */

namespace Cib\Bundle\LicenseBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;


class MenuBuilder
{

    private $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createLicenseMenu(Request $request)
    {
        $menu = $this->factory->createItem('license');
        $menu->setChildrenAttribute('class','nav navbar-nav');
        $menu->addChild('Licences',array('route' => 'displayGlobalLicenses'));

        return $menu;
    }

}