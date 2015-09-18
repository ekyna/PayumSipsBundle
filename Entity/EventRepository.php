<?php

namespace Ekyna\Bundle\AgendaBundle\Entity;

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Ekyna\Bundle\AdminBundle\Doctrine\ORM\TranslatableResourceRepository;
use Ekyna\Bundle\AgendaBundle\Model\EventInterface;

/**
 * Class EventRepository
 * @package Ekyna\Bundle\AgendaBundle\Entity
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class EventRepository extends TranslatableResourceRepository
{
    /**
     * Returns the front events pager.
     *
     * @param integer $currentPage
     * @param integer $maxPerPage
     * @return \Pagerfanta\Pagerfanta
     */
    public function createFrontPager($currentPage, $maxPerPage = 12)
    {
        $qb = $this->getCollectionQueryBuilder();

        $query = $qb
            ->addOrderBy('e.startDate', 'asc')
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
            ->andWhere($qb->expr()->gte('e.startDate', ':today'))
            ->getQuery()
        ;

        $today = new \DateTime();
        $today->setTime(0,0,0);
        $query
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
        ;

        return $this
            ->getPager($query)
            ->setMaxPerPage($maxPerPage)
            ->setCurrentPage($currentPage)
        ;
    }

    /**
     * Finds one event by slug.
     *
     * @param string $slug
     * @return EventInterface|null
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
     * Finds the upcoming events.
     *
     * @param int $limit
     * @return EventInterface[]
     */
    public function findUpComing($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(0,0,0);

        $qb = $this->getCollectionQueryBuilder();
        $qb
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
            ->andWhere($qb->expr()->gte('e.startDate', ':today'))
            ->addOrderBy('e.startDate', 'ASC')
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
            ->getQuery()
        ;

        return new Paginator($qb->getQuery(), true);
    }

    /**
     * Finds the latest events.
     *
     * @param int $limit
     * @return EventInterface[]
     */
    public function findLatest($limit = 3)
    {
        $today = new \DateTime();
        $today->setTime(23,59,59);

        $qb = $this->getCollectionQueryBuilder();
        $qb
            ->andWhere($qb->expr()->eq('e.enabled', ':enabled'))
            ->andWhere($qb->expr()->lte('e.endDate', ':today'))
            ->addOrderBy('e.endDate', 'DESC')
            ->setMaxResults($limit)
            ->setParameter('enabled', true)
            ->setParameter('today', $today, Type::DATETIME)
            ->getQuery()
        ;

        return new Paginator($qb->getQuery(), true);
    }

    /**
     * Finds the events by date range.
     *
     * @param \DateTime $startDate
     * @param \DateTime $endDate
     * @return EventInterface[]
     */
    public function findByDateRange(\DateTime $startDate, \DateTime $endDate)
    {
        $qb = $this
            ->getCollectionQueryBuilder()
            ->join('e.category', 'c')
        ;

        $qb
            ->andWhere($qb->expr()->gte('e.startDate', ':startDate'))
            ->andWhere($qb->expr()->lte('e.endDate', ':endDate'))
            ->setParameter('startDate', $startDate, Type::DATETIME)
            ->setParameter('endDate', $endDate, Type::DATETIME)
        ;

        return new Paginator($qb->getQuery(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function getAlias()
    {
        return 'e';
    }
}
