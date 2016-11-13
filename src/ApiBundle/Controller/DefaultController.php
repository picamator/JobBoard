<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /** @var \ApiBundle\Model\Manager\PublisherStatusManager $manager */
        $manager = $this->get('publisher_status_manager');
        var_dump($manager->getActive(), $manager->getInactive(), $manager->getAwaitingModeration());

        return $this->render('ApiBundle:Default:index.html.twig');
    }
}
