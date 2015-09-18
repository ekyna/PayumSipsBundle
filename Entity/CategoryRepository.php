<?php

namespace Ekyna\Bundle\BlogBundle\Entity;

use Ekyna\Bundle\AdminBundle\Doctrine\ORM\TranslatableResourceRepositoryInterface;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\Util\TranslatableResourceRepositoryTrait;
use Ekyna\Bundle\BlogBundle\Model\CategoryInterface;
use Gedmo\Sortable\Entity\Repository\SortableRepository;

/**
 * Class CategoryRepository
 * @package Ekyna\Bundle\BlogBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryRepository extends SortableRepository implements TranslatableResourceRepositoryInterface
{
    use TranslatableResourceRepositoryTrait;

    /**
     * Finds one news by slug.
     *
     * @param string $slug
     * @return CategoryInterface|null
     */
    public function findOneBySlug($slug)
    {
        if (0 == strlen($slug)) {
            return null;
        }

        return $this->findOneBy(array(
            'enabled' => true,
            'slug' => $slug
        ));
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'c';
    }
}
