<?php

namespace Ekyna\Bundle\AgendaBundle\Controller;

use Ekyna\Bundle\AgendaBundle\Entity\Event;
use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExampleController
 * @package Ekyna\Bundle\AgendaBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ExampleController extends Controller
{
    /**
     * Example index page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $currentPage = $request->query->get('page', 1);

        $pager = $this
            ->get('ekyna_agenda.event.repository')
            ->createFrontPager($currentPage, 12)
        ;

        /** @var \Ekyna\Bundle\AgendaBundle\Model\EventInterface[] $events */
        $events = $pager->getCurrentPageResults();

        $response = $this->render('EkynaAgendaBundle:Example:index.html.twig', array(
            'pager'  => $pager,
            'events' => $events,
        ));

        $tags = [Event::getEntityTagPrefix()];
        foreach ($events as $event) {
            $tags[] = $event->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Example detail page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     */
    public function detailAction(Request $request)
    {
        $repo = $this->get('ekyna_agenda.event.repository');

        $event = $repo->findOneBySlug($request->attributes->get('slug'));

        if (null === $event) {
            throw new NotFoundHttpException('Event not found.');
        }
        // TODO check translation locale (slug is translated)

        $latest = $repo->findLatest();

        $response = $this->render('EkynaAgendaBundle:Example:detail.html.twig', array(
            'event' => $event,
            'latest' => $latest,
        ));

        $tags = [Event::getEntityTagPrefix(), $event->getEntityTag()];
        foreach ($latest as $l) {
            $tags[] = $l->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }
}