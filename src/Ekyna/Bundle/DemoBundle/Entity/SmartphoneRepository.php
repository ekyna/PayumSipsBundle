<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepository;

/**
 * Class SmartphoneRepository
 * @package Ekyna\Bundle\DemoBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneRepository extends ResourceRepository
{
    public function createNew()
    {
        $class = $this->getClassName();
        return new $class;
    }
}
