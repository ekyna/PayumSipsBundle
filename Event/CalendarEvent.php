<?php

namespace Ekyna\Bundle\AgendaBundle\Event;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Bundle\AgendaBundle\Model\EventInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CalendarEvent
 * @package Ekyna\Bundle\AgendaBundle\Event
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CalendarEvent extends Event
{
    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var ArrayCollection
     */
    private $events;


    /**
     * Constructor.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @param Request   $request
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate, Request $request = null)
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
        $this->request   = $request;
        $this->events    = new ArrayCollection();
    }

    /**
     * Returns the startDate.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Returns the endDate.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Returns the request.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Returns the events.
     *
     * @return ArrayCollection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Adds the event.
     *
     * @param EventInterface $event
     * @return CalendarEvent
     */
    public function addEvent(EventInterface $event)
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
        }
        return $this;
    }
}
