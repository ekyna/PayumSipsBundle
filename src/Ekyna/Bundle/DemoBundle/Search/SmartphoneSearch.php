<?php

namespace Ekyna\Bundle\DemoBundle\Search;

use Doctrine\ORM\EntityRepository;
use Ekyna\Bundle\DemoBundle\Entity\Category;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class SmartphoneSearch
 * @package Ekyna\Bundle\DemoBundle\Search
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SmartphoneSearch
{
    /**
     * @var \Ekyna\Bundle\DemoBundle\Entity\SmartphoneRepository
     */
    private $repository;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var integer
     */
    private $defaultLimit;

    /**
     * @var integer
     */
    private $limit;

    /**
     * @var integer
     */
    private $page;


    /**
     * Constructor.
     *
     * @param EntityRepository $repository
     * @param int $defaultLimit
     */
    public function __construct(EntityRepository $repository, $defaultLimit = 6)
    {
        $this->repository = $repository;
        $this->defaultLimit = (0 < $defaultLimit = intval($defaultLimit)) ? $defaultLimit : 6;
        
        $this->clear();
    }

    /**
     * Returns products pager
     * 
     * @return \Pagerfanta\Pagerfanta
     */
    public function findProducts()
    {
        $qb = $this->repository->createQueryBuilder('p');

        if(null !== $this->category) {
            $qb
                ->andWhere($qb->expr()->eq('p.category', ':category'))
                ->setParameter('category', $this->category)
            ;
        }

        $adapter = new DoctrineORMAdapter($qb);
        $pager = new Pagerfanta($adapter);
        $pager
            ->setNormalizeOutOfRangePages(true)
            ->setMaxPerPage($this->limit)
            ->setCurrentPage($this->page)
        ;

        return $pager;
    }

    /**
     * Clear search parameters
     * 
     * @return SmartphoneSearch
     */
    public function clear()
    {
        $this->setCategory(null);
        $this->setLimit($this->defaultLimit);
        $this->setPage(1);

        return $this;
    }

	/**
	 * Sets the category
	 * 
     * @param \Ekyna\Bundle\DemoBundle\Entity\Category $category
     * @return SmartphoneSearch
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

	/**
	 * Sets the limit
	 * 
     * @param number $limit
     * @return SmartphoneSearch
     */
    public function setLimit($limit)
    {
        $this->limit = (0 < $limit = intval($limit)) ? $limit : 6;

        return $this;
    }

	/**
	 * Sets the page
	 * 
     * @param number $page
     * @return SmartphoneSearch
     */
    public function setPage($page)
    {
        $this->page = (0 < $page = intval($page)) ? $page : 1;

        return $this;
    }
}
