<?php

namespace Ekyna\Bundle\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Ekyna\Bundle\MediaBundle\Model\MediaTypes;

/**
 * Class LoadBrandData
 * @package Ekyna\Bundle\DemoBundle\DataFixtures\ORM
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class LoadBrandData extends AbstractFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $om)
    {
        $repo = $this->container->get('ekyna_demo.brand.repository');
        $seoRepo = $this->container->get('ekyna_cms.seo.repository');

        for ($b = 1; $b < 6; $b++) {
            /** @var \Ekyna\Bundle\DemoBundle\Entity\Brand $brand */
            $brand = $repo->createNew();
            $brand
                ->setTitle('Brand #' . $b)
                // TODO image (uploadable)
            ;

            $seo = $seoRepo->createNew();
            $seo
                ->setTitle('Brand #' . $b . ' title')
                ->setDescription('Brand #' . $b . ' description')
            ;

            $om->persist($brand);
        }
        $om->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 90;
    }
}