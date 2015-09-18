<?php

namespace Ekyna\Component\Sale\Product;

/**
 * Class ProductTypes
 * @package Ekyna\Component\Sale\Product
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
final class ProductTypes
{
    const PHYSICAL      = 'physical';
    const VIRTUAL       = 'virtual';
    const DOWNLOADABLE  = 'downloadable';

    /**
     * Returns whether the given type is valid or not.
     *
     * @param $type
     * @return boolean
     */
    public static function isValid($type)
    {
        return in_array($type, array_keys(self::getChoices()));
    }

    /**
     * Returns the choices.
     *
     * @return array
     */
    public static function getChoices()
    {
        return array(
            self::PHYSICAL     => 'ekyna_product.type.'.self::PHYSICAL,
            self::VIRTUAL      => 'ekyna_product.type.'.self::VIRTUAL,
            self::DOWNLOADABLE => 'ekyna_product.type.'.self::DOWNLOADABLE,
        );
    }
}
