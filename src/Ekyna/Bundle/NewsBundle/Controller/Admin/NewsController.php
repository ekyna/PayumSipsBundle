<?php

namespace Ekyna\Bundle\NewsBundle\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Controller\Resource\ToggleableTrait;
use Ekyna\Bundle\AdminBundle\Controller\ResourceController;
use Ekyna\Bundle\AdminBundle\Controller\Resource\TinymceTrait;

/**
 * Class NewsController
 * @package Ekyna\Bundle\NewsBundle\Controller\Admin
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class NewsController extends ResourceController
{
    use TinymceTrait;
    use ToggleableTrait;
}
