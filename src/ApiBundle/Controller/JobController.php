<?php
namespace ApiBundle\Controller;

use ApiBundle\Service\Controller\Job\GetService;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class JobController extends FOSRestController implements ClassResourceInterface
{
    /**
     * GET: job
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction(Request $request)
    {
        $startAt    = $request->query->get('startAt', 1);
        $maxPerPage = $request->query->get('maxPerPage', 20);

        /** @var GetService $service */
        $service    = $this->get('service_job_get');
        $response   = $service->getJob($startAt, $maxPerPage);

        // @todo find way to configure serialize to use explicitly json encode
        $data = json_decode(json_encode($response), true);
        $view = $this->view($data, $response->getCode());

        return $this->handleView($view);
    }

    /**
     * POST: job
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAction(Request $request)
    {
        $content = $request->getContent();

        /** @var PostService $service */
        $service    = $this->get('service_job_post');
        $response   = $service->postJob($content);

        // @todo find way to configure serialize to use explicitly json encode
        $data = json_decode(json_encode($response), true);
        $view = $this->view($data, $response->getCode());

        return $this->handleView($view);
    }

    /**
     * PUT: job
     */
    public function putAction()
    {

    }

    /**
     * DELETE: job
     */
    public function deleteAction()
    {

    }
}
