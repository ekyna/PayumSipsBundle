<?php

namespace Ekyna\Bundle\DemoBundle\Order;

use Ekyna\Bundle\DemoBundle\Entity\Smartphone;
use Ekyna\Bundle\DemoBundle\Entity\SmartphoneRepository;
use Ekyna\Bundle\OrderBundle\Exception\InvalidItemException;
use Ekyna\Bundle\OrderBundle\Exception\InvalidSubjectException;
use Ekyna\Bundle\OrderBundle\Provider\AbstractItemProvider;
use Ekyna\Component\Sale\Order\OrderItemInterface;

/**
 * Class OrderItemProvider
 * @package Ekyna\Bundle\DemoBundle\Order
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class OrderItemProvider extends AbstractItemProvider
{
    /**
     * @var SmartphoneRepository
     */
    protected $repository;


    /**
     * Constructor.
     *
     * @param SmartphoneRepository $repository
     */
    public function __construct(SmartphoneRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     * @param \Ekyna\Bundle\DemoBundle\Entity\Smartphone $subject
     * @throws InvalidSubjectException
     */
    public function transform($subject)
    {
        if (!$this->supports($subject)) {
            throw new InvalidSubjectException('Ekyna\Bundle\DemoBundle\Entity\Smartphone');
        }

        $item = $this->createNewOrderItem();
        $item
            ->setDesignation($subject->getDesignation())
            ->setReference($subject->getReference())
            ->setPrice($subject->getPrice())
            ->setTax($subject->getTax())
            ->setWeight($subject->getWeight())
            ->setSubjectType($this->getName())
            ->setSubjectData(array(
                'id' => $subject->getId()
            ))
            ->setSubject($subject)
        ;

        return $item;
    }

    /**
     * {@inheritdoc}
     * @return Smartphone
     * @throws InvalidItemException
     */
    public function reverseTransform(OrderItemInterface $item)
    {
        if (!$this->supports($item)) {
            throw new InvalidItemException('Unsupported order item.');
        }

        return $this->repository->findOneBy(['id' => $item->getSubjectData()['id']]);
    }

    /**
     * {@inheritdoc}
     * @throws InvalidItemException
     */
    public function getFormOptions(OrderItemInterface $item, $property)
    {
        if (!$this->supports($item)) {
            throw new InvalidItemException('Unsupported order item.');
        }

        return array();
    }

    /**
     * {@inheritdoc}
     * @throws InvalidSubjectException
     */
    public function generateFrontOfficePath($subjectOrOrderItem)
    {
        if ($subjectOrOrderItem instanceof OrderItemInterface) {
            $smartphone = $this->reverseTransform($subjectOrOrderItem);
        } elseif ($subjectOrOrderItem instanceof Smartphone) {
            $smartphone = $subjectOrOrderItem;
        } else {
            throw new InvalidSubjectException('Ekyna\Bundle\DemoBundle\Entity\Smartphone');
        }

        return $this->urlGenerator->generate('ekyna_demo_catalog_product', array(
            'categorySlug' => $smartphone->getCategory()->getSlug(),
            'productSlug'  => $smartphone->getSlug(),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function generateBackOfficePath($subjectOrOrderItem)
    {
        if ($subjectOrOrderItem instanceof OrderItemInterface) {
            $smartphone = $this->reverseTransform($subjectOrOrderItem);
        } elseif ($subjectOrOrderItem instanceof Smartphone) {
            $smartphone = $subjectOrOrderItem;
        } else {
            throw new InvalidSubjectException('Ekyna\Bundle\DemoBundle\Entity\Smartphone');
        }

        return $this->urlGenerator->generate('ekyna_demo_smartphone_admin_show', array(
            'smartphoneId'  => $smartphone->getId(),
        ));
    }

    /**
     * Returns whether the provider supports the given subject or order item.
     *
     * @param object $subjectOrOrderItem
     * @return boolean
     */
    public function supports($subjectOrOrderItem)
    {
        if ($subjectOrOrderItem instanceof Smartphone) {
            return true;
        }

        if ($subjectOrOrderItem instanceof OrderItemInterface) {
            return $subjectOrOrderItem->getSubjectType() === $this->getName()
                && array_key_exists('id', $subjectOrOrderItem->getSubjectData());
        }

        return false;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'smartphone';
    }
}
