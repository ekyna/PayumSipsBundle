<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Ekyna\Bundle\AdminBundle\Model\AbstractTranslatable;
use Ekyna\Bundle\AgendaBundle\Model\EventInterface;
use Ekyna\Bundle\CoreBundle\Model as Core;

/**
 * Class Event
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 *
 * @method EventTranslation translate($locale = null, $create = false)
 */
class Event extends AbstractTranslatable implements EventInterface
{
    use Core\TimestampableTrait;
    use Core\TaggedEntityTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @var bool
     */
    protected $enabled = false;


    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Serializes the event.
     *
     * @return array
     */
    public function serialize()
    {
        $data =  array(
            'id'              => $this->id,
            'title'           => $this->getTitle(),
            'allDay'          => false,
            'start'           => $this->startDate->format('Y-m-d\TH:i:sP'),
            'backgroundColor' => '#dddddd',
            'borderColor'     => '#dddddd',
            'textColor'       => '#333333',
            'enabled'         => $this->enabled,
        );

        if (null !== $this->endDate) {
            $data['end'] = $this->endDate->format('Y-m-d\TH:i:sP');
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setTitle($title)
    {
        $this->translate()->setTitle($title);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle()
    {
        return $this->translate()->getTitle();
    }

    /**
     * {@inheritdoc}
     */
    public function setContent($content)
    {
        $this->translate()->setContent($content);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getContent()
    {
        return $this->translate()->getContent();
    }

    /**
     * {@inheritdoc}
     */
    public function setSlug($slug)
    {
        $this->translate()->setSlug($slug);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSlug()
    {
        return $this->translate()->getSlug();
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate(\DateTime $startDate = null)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndDate(\DateTime $endDate = null)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_agenda.event';
    }
}
