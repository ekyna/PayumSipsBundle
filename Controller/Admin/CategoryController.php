<?php

namespace Ekyna\Bundle\BlogBundle\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Controller\Resource\SortableTrait;
use Ekyna\Bundle\AdminBundle\Controller\Resource\ToggleableTrait;
use Ekyna\Bundle\AdminBundle\Controller\ResourceController;

/**
 * Class CategoryController
 * @package Ekyna\Bundle\BlogBundle\Controller\Admin
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CategoryController extends ResourceController
{
    use SortableTrait;
    use ToggleableTrait;
}
