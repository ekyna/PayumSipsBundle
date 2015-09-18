<?php

namespace Ekyna\Bundle\BlogBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\ResourceRepository;
use Ekyna\Bundle\BlogBundle\Model\CategoryInterface;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class PostRepository
 * @package Ekyna\Bundle\BlogBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PostRepository extends ResourceRepository
{
    protected $maxPerPage = 6;

    /**
     * Returns the listing pager.
     *
     * @param $currentPage
     * @param CategoryInterface $category
     * @return Pagerfanta
     */
    public function getPaginatedList($currentPage, CategoryInterface $category = null)
    {
        $qb = $this->getCollectionQueryBuilder();
        $params = [];
        $now = new \DateTime();

        $qb
            ->andWhere($qb->expr()->isNotNull('p.publishedAt'))
            ->andWhere($qb->expr()->lte('p.publishedAt', ':now'))
            ->addOrderBy('p.publishedAt', 'DESC')
        ;

        if (null !== $category) {
            $qb
                ->join('p.category', 'c')
                ->andWhere($qb->expr()->eq('c', ':category'))
                ->andWhere($qb->expr()->eq('c.enabled', ':enabled'))
            ;
            $params['category'] = $category;
            $params['enabled'] = true;
        }

        $query = $qb->getQuery();
        $query
            ->setParameters($params)
            ->setParameter('now', $now, Type::DATETIME)
        ;

        $pager = new Pagerfanta(new DoctrineORMAdapter($query));
        $pager
            ->setNormalizeOutOfRangePages(true)
            ->setMaxPerPage($this->maxPerPage)
            ->setCurrentPage($currentPage)
        ;

        return $pager;
    }

    /**
     * Finds one post by slug, and optionally by category.
     *
     * @param string $slug
     * @param CategoryInterface $category
     * @return \Ekyna\Bundle\BlogBundle\Model\PostInterface|null
     */
    public function findOneBySlug($slug, CategoryInterface $category = null)
    {
        if (0 === strlen($slug)) {
            return null;
        }

        $qb = $this->getQueryBuilder();
        $params = ['slug' => $slug];
        $now = new \DateTime();

        $qb
            ->andWhere($qb->expr()->isNotNull('p.publishedAt'))
            ->andWhere($qb->expr()->lte('p.publishedAt', ':now'))
            ->andWhere($qb->expr()->eq('p.slug', ':slug'))
            ->getQuery()
        ;

        if (null !== $category) {
            $qb
                ->join('p.category', 'c')
                ->andWhere($qb->expr()->eq('c', ':category'))
                ->andWhere($qb->expr()->eq('c.enabled', ':enabled'))
            ;
            $params['category'] = $category;
            $params['enabled'] = true;
        }

        return $qb
            ->getQuery()
            ->setMaxResults(1)
            ->setParameters($params)
            ->setParameter('now', $now, Type::DATETIME)
            ->getOneOrNullResult()
        ;
    }

    /**
     * Finds the latest posts, optionally filtered by category.
     *
     * @param CategoryInterface $category
     * @param integer $limit
     * @return \Ekyna\Bundle\BlogBundle\Model\PostInterface[]
     */
    public function findLatest(CategoryInterface $category = null, $limit = 3)
    {
        $qb = $this->getCollectionQueryBuilder();
        $params = [];
        $now = new \DateTime();

        $qb
            ->andWhere($qb->expr()->isNotNull('p.publishedAt'))
            ->andWhere($qb->expr()->lte('p.publishedAt', ':now'))
            ->addOrderBy('p.publishedAt', 'DESC')
            ->getQuery()
        ;

        if (null !== $category) {
            $qb
                ->join('p.category', 'c')
                ->andWhere($qb->expr()->eq('c', ':category'))
                ->andWhere($qb->expr()->eq('c.enabled', ':enabled'))
            ;
            $params['category'] = $category;
            $params['enabled'] = true;
        }

        $qb
            ->setMaxResults($limit)
            ->setParameters($params)
            ->setParameter('now', $now, Type::DATETIME)
            ->getQuery()
        ;

        return new Paginator($qb->getQuery(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'p';
    }
}
