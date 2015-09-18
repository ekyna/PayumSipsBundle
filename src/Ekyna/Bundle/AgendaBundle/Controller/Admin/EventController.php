<?php

namespace Ekyna\Bundle\AgendaBundle\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Controller\Resource;
use Ekyna\Bundle\AdminBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class EventController
 * @package Ekyna\Bundle\AgendaBundle\Controller\Admin
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventController extends ResourceController
{
    use Resource\TinymceTrait,
        Resource\ToggleableTrait;

    /**
     * {@inheritdoc}
     */
    public function listAction(Request $request)
    {
        $config = $this->container->getParameter('ekyna_agenda.admin_config');
        if ($request->isXmlHttpRequest() || !$config['calendar']) {
            return parent::listAction($request);
        }

        $this->isGranted('VIEW');

        $context = $this->loadContext($request);

        $response = new Response();

        $format = 'html';
        if ($request->isXmlHttpRequest()) {
            $format = 'xml';
            $response->headers->add(array(
                'Content-Type' => 'application/xml; charset=' . strtolower($this->get('kernel')->getCharset())
            ));
        }

        $params = $context->getTemplateVars();

        $response->setContent($this->renderView(
            $this->config->getTemplate('list.' . $format),
            $params
        ));

        return $response;
    }
}
