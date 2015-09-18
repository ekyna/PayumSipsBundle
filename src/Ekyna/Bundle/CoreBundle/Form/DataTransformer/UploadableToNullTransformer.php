<?php

namespace Ekyna\Bundle\CoreBundle\Form\DataTransformer;

use Ekyna\Bundle\CoreBundle\Model\UploadableInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Class UploadableToNullTransformer
 * @package Ekyna\Bundle\CoreBundle\Form\DataTransformer
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class UploadableToNullTransformer implements DataTransformerInterface
{
    /**
     * {@inheritdoc}
     */
    public function transform($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($value)
    {
        if ($value instanceof UploadableInterface && $value->getUnlink()) {
            return null;
        }

        return $value;
    }
}
