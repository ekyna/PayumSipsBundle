<?php

namespace Ekyna\Bundle\NewsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadEventData
 * @package Ekyna\Bundle\NewsBundle\DataFixtures\ORM
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
        $repo = $this->container->get('ekyna_news.news.repository');

        for ($e = 1; $e < 100; $e++) {
            $date = $faker->dateTimeBetween('-1 year', 'now');

            /** @var \Ekyna\Bundle\NewsBundle\Model\NewsInterface $event */
            $event = $repo->createNew();
            $event
                ->setName(sprintf('News %d name', $e))
                ->setTitle(sprintf('News %d title', $e))
                ->setDate($date)
                ->setEnabled(rand(0,100) > 30)
                ->setContent('<p>' . $faker->paragraph(rand(4, 6)) . '</p>')
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
