<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 02/07/14
 * Time: 11:22
 */

namespace Cib\Bundle\CoreBundle\Menu;


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

    public function createIndexMenu(Request $request)
    {
        $menu = $this->factory->createItem('index');
        $menu->setChildrenAttribute('class','nav navbar-nav');
        $menu->addChild('Accueil',array('route' => 'index'));

        return $menu;
    }
} 