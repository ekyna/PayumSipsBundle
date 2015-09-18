<?php

namespace Ekyna\Bundle\AgendaBundle\EventListener;

use Ekyna\Bundle\AgendaBundle\Entity\EventRepository;
use Ekyna\Bundle\AgendaBundle\Event\CalendarEvent;
use Ekyna\Bundle\AgendaBundle\Event\CalendarEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class CalendarEventListener
 * @package Ekyna\Bundle\AgendaBundle\EventListener
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CalendarEventListener implements EventSubscriberInterface
{
    /**
     * @var EventRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param EventRepository $repository
     */
    public function __construct(EventRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Calendar configure event handler.
     *
     * @param CalendarEvent $calendarEvent
     */
    public function onCalendarLoadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDate();
        $endDate = $calendarEvent->getEndDate();

        /*$request = $calendarEvent->getRequest();
        $filter = $request->get('filter');*/

        $events = $this->repository->findByDateRange($startDate, $endDate);
        foreach($events as $event) {
            $calendarEvent->addEvent($event);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            CalendarEvents::LOAD_EVENTS => array('onCalendarLoadEvents', 0),
        );
    }
}
