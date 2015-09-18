<?php

namespace Ekyna\Bundle\AgendaBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiController
 * @package Ekyna\Bundle\AgendaBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ApiController extends Controller
{
    /**
     * Load events action.
     *
     * @param Request $request
     * @return Response
     */
    public function loadEventsAction(Request $request)
    {
        $startDate = new \DateTime($request->get('start'));
        $endDate = new \DateTime($request->get('end'));

        /*$request = $calendarEvent->getRequest();
        $filter = $request->get('filter');*/

        $events = $this
            ->get('ekyna_agenda.event.repository')
            ->findByDateRange($startDate, $endDate)
        ;

        $calendarEvents = [];
        foreach ($events as $event) {
            $calendarEvents[] = $event->serialize();
        }

        $response = new Response();
        $response
            ->setContent(json_encode($calendarEvents))
            ->headers->set('Content-Type', 'application/json')
        ;

        return $response;
    }
}
