<?php

namespace Ekyna\Bundle\PaymentBundle\Payum\Action;

//use Ekyna\Bundle\PaymentBundle\Payum\Request\GetStatus;
use Ekyna\Component\Sale\Payment\PaymentInterface;
use Payum\Core\Action\PaymentAwareAction;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\GetStatusInterface;

/**
 * Class PaymentStatusAction
 * @package Ekyna\Bundle\PaymentBundle\Payum\Action
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PaymentStatusAction extends PaymentAwareAction
{
    /**
     * {@inheritDoc}
     */
    public function execute($request)
    {
        RequestNotSupportedException::assertSupports($this, $request);

        /** @var PaymentInterface $payment */
        $payment = $request->getModel();

        if ($payment->getDetails()) {
            $request->setModel($payment->getDetails());

            $this->payment->execute($request);

            $request->setModel($payment);
        } else {
            $request->markNew();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function supports($request)
    {
        return
            $request instanceof GetStatusInterface &&
            $request->getModel() instanceof PaymentInterface
        ;
    }
}
