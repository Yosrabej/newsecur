<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;



class LoadData implements ContainerAwareInterface
{
    private $container;
    public function load(ObjectManager $objectManager)
    {
        // $entityManager = $this->getDoctrine()->getManager();
        //$user = $this->getUser();
        $user = new User();
        $user->setUsername('admin');
        $user->setEmail('admin@gmail.com');


        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encoderpassword($user, '0000');
        $user->setPassword($password);
        $objectManager->persist($user);
        $objectManager->flush();
    }
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
