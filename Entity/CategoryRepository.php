<?php

namespace Ekyna\Bundle\DemoBundle\Entity;

use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepositoryInterface;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\Util\ResourceRepositoryTrait;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class CategoryRepository
 * @package Ekyna\Bundle\DemoBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryRepository extends NestedTreeRepository implements ResourceRepositoryInterface
{
    use ResourceRepositoryTrait;

    public function findBySlug($categorySlug)
    {
        $category = null;

        $slugs = explode('/', trim($categorySlug, '/'));
        if (count($slugs) > 0) {
            $slugs = array_reverse($slugs);
            if (null !== $category = $this->findOneBy(array('slug' => array_shift($slugs)))) {
                $parent = $category;
                while(count($slugs) > 0) {
                    if($parent->getSlug() !== array_shift($slugs)) {
                        $category = null;
                    }
                    if(null === $parent = $parent->getParent()) {
                        break;
                    }
                }
            }
        }

        return $category;
    }
}
