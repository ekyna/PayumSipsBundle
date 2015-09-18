<?php

namespace Ekyna\Component\Sale\Payment;

use Doctrine\Common\Collections\ArrayCollection;
use Ekyna\Bundle\CoreBundle\Model\TimestampableInterface;
use Ekyna\Bundle\MediaBundle\Model\MediaSubjectInterface;
use Ekyna\Bundle\PaymentBundle\Entity\Message;

/**
 * Interface MethodInterface
 * @package Ekyna\Component\Sale\Payment
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
interface MethodInterface extends MediaSubjectInterface, TimestampableInterface
{
    /**
     * Returns the identifier.
     *
     * @return integer
     */
    public function getId();

    /**
     * Sets the payment name.
     * @param string $paymentName
     * @return MethodInterface|$this
     */
    public function setPaymentName($paymentName);

    /**
     * Returns the payment name.
     *
     * @return string
     */
    public function getPaymentName();

    /**
     * Sets the factory name.
     *
     * @param string $name
     * @return MethodInterface|$this
     */
    public function setFactoryName($name);

    /**
     * Returns the factory name.
     *
     * @return string
     */
    public function getFactoryName();

    /**
     * Sets the config.
     *
     * @param array $config
     * @return MethodInterface|$this
     */
    public function setConfig(array $config);

    /**
     * Returns the config.
     *
     * @return array
     */
    public function getConfig();

    /**
     * Sets the description.
     *
     * @param string $description
     * @return MethodInterface|$this
     */
    public function setDescription($description);

    /**
     * Returns the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Sets the messages.
     *
     * @param ArrayCollection $messages
     * @return MethodInterface|$this
     */
    public function setMessages(ArrayCollection $messages);

    /**
     * Returns whether the method as the message or not.
     *
     * @param Message $message
     * @return bool
     */
    public function hasMessage(Message $message);

    /**
     * Adds the message.
     *
     * @param Message $message
     * @return MethodInterface|$this
     */
    public function addMessage(Message $message);

    /**
     * Removes the message.
     *
     * @param Message $message
     * @return MethodInterface|$this
     */
    public function removeMessage(Message $message);

    /**
     * Returns the messages.
     *
     * @return ArrayCollection
     */
    public function getMessages();

    /**
     * Sets the enabled.
     *
     * @param boolean $enabled
     * @return MethodInterface|$this
     */
    public function setEnabled($enabled);

    /**
     * Returns the enabled.
     *
     * @return boolean
     */
    public function getEnabled();

    /**
     * Sets the createdAt.
     *
     * @param \DateTime $createdAt
     * @return MethodInterface|$this
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Returns the createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt();
}
