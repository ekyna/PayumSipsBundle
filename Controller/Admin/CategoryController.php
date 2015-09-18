<?php

namespace Ekyna\Bundle\DemoBundle\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Controller\ResourceController;
use Ekyna\Bundle\AdminBundle\Controller\Resource\NestedTrait;
use Ekyna\Bundle\AdminBundle\Controller\Resource\TinymceTrait;

/**
 * Class CategoryController
 * @package Ekyna\Bundle\DemoBundle\Controller\Admin
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryController extends ResourceController
{
    use NestedTrait;
    use TinymceTrait;
}
