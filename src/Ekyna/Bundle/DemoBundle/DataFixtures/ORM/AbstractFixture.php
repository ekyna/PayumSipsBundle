<?php

namespace Ekyna\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture as BaseFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Ekyna\Bundle\MediaBundle\Model\MediaTypes;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractFixtures
 * @package Ekyna\Bundle\DemoBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractFixture extends BaseFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Faker\Generator
     */
    protected $faker;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;

        $this->faker = Factory::create($this->container->getParameter('hautelook_alice.locale'));
    }

    /**
     * Returns a randomly selected media, optionally filtered by type.
     *
     * @param string $type
     * @return \Ekyna\Bundle\MediaBundle\Model\MediaInterface
     */
    protected function getRandomMedia($type = null)
    {
        $criteria = [];
        if ($type) {
            MediaTypes::isValid($type, true);
            $criteria['type'] = $type;
        }

        return $this->container
            ->get('ekyna_media.media.repository')
            ->findRandomOneBy($criteria)
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 99;
    }
}
