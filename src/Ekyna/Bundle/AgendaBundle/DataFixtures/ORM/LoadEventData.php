<?php

namespace Ekyna\Bundle\AgendaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEventData
 * @package Ekyna\Bundle\AgendaBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadEventData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        $faker = Factory::create($this->container->getParameter('hautelook_alice.locale'));
        $repo = $this->container->get('ekyna_agenda.event.repository');

        for ($e = 1; $e < 100; $e++) {
            $startDate = $faker->dateTimeBetween('-3 months', 'now');
            $endDate = clone $startDate;
            $endDate->modify(sprintf('+%s hours', rand(1, 8)));

            /** @var \Ekyna\Bundle\AgendaBundle\Model\EventInterface $event */
            $event = $repo->createNew();
            $event
                ->setTitle(sprintf('Agenda event %d title', $e))
                ->setContent('<p>' . $faker->paragraph(rand(4, 6)) . '</p>')
                ->setStartDate($startDate)
                ->setEndDate($endDate)
                ->setEnabled(true)
            ;

            $om->persist($event);

            if ($e % 20 === 0) {
                $om->flush();
            }
        }
        $om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 99;
    }
}
