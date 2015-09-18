<?php

namespace Ekyna\Bundle\DemoBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Ekyna\Bundle\DemoBundle\Entity\Category;
use Ekyna\Bundle\DemoBundle\Entity\Smartphone;
use Ekyna\Bundle\OrderBundle\Exception\OrderException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * CatalogController.
 *
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class CatalogController extends Controller
{
    public function sideMenuAction()
    {
        /** @var Category[] $categories */
        $categories = $this->get('ekyna_demo.category.repository')->findAll();

        // TODO knp_menu

        $response = $this->render('EkynaDemoBundle:Catalog:side_menu.html.twig', array(
            'categories' => $categories
        ));

        $tags = [Category::getEntityTagPrefix()];
        foreach ($categories as $category) {
            $tags[] = $category->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Renders the catalog index page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        /** @var Smartphone[] $products */
        $products = $this->get('ekyna_demo.smartphone.search')
            ->setPage($request->query->get('page', 1))
            ->findProducts()
        ;

        $response = $this->render('EkynaDemoBundle:Catalog:index.html.twig', array(
            'products' => $products
        ));

        $tags = [Smartphone::getEntityTagPrefix()];
        foreach ($products as $product) {
            $tags[] = $product->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Renders the catalog category page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction(Request $request)
    {
        $category = $this->findCategory($request);

        $this->get('ekyna_cms.menu.builder')->breadcrumbAppend(
            'category-'.$category->getId(),
            $category,
            'ekyna_demo_catalog_category',
            array('categorySlug' => $category->getSlug())
        );

        /** @var Smartphone[] $products */
        $products = $this->get('ekyna_demo.smartphone.search')
            ->setCategory($category)
            ->setPage($request->query->get('page', 1))
            ->findProducts()
        ;

        $response = $this->render('EkynaDemoBundle:Catalog:category.html.twig', array(
            'category' => $category,
            'products' => $products
        ));

        $tags = [Category::getEntityTagPrefix(), Smartphone::getEntityTagPrefix()];
        $tags = array_merge($tags, $category->getEntityTags());
        foreach ($products as $product) {
            $tags[] = $product->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Renders the catalog product page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws OrderException
     */
    public function productAction(Request $request)
    {
        $category = $this->findCategory($request);
        $product = $this->findProduct($request);

        if ($category !== $product->getCategory()) {
            throw new NotFoundHttpException('Product not found.');
        }

        $this->get('ekyna_cms.menu.builder')->breadcrumbAppend(
            'product-'.$product->getId(),
            (string) $product,
            'ekyna_demo_catalog_product',
            array(
                'categorySlug' => $category->getSlug(),
                'productSlug' => $product->getSlug(),
            )
        );

        $data = array(
            'product' => $product,
            'quantity' => 1,
            // TODO options
        );

        $form = $this->createForm('ekyna_product_add_to_order', $data);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $cart = $this->get('ekyna_cart.cart.provider')->getCart();
            try {
                $event = $this
                    ->get('ekyna_order.order_helper')
                    ->addSubject($cart, $data['product'], $data['quantity'])
                ;
                if (!$event->isPropagationStopped()) {
                    $this->addFlash($this->getTranslator()->trans('ekyna_cart.message.item_add.success', array(
                        '{{ name }}' => $product->getDesignation(),
                        '{{ path }}' => $this->generateUrl('ekyna_cart_index'),
                    )), 'success');
                    return $this->redirect($this->generateUrl('ekyna_demo_catalog_product', array(
                        'categorySlug' => $product->getCategory()->getSlug(),
                        'productSlug' => $product->getSlug(),
                    )));
                }
            } catch(OrderException $e) {
                if ($this->container->getParameter('kernel.debug')) {
                    throw $e;
                }
            }
            $this->addFlash($this->getTranslator()->trans('ekyna_cart.message.item_add.failure', array(
                '{{ name }}' => $product->getDesignation(),
                '{{ path }}' => $this->generateUrl('ekyna_cart_index'),
            )), 'danger');
        }

        $response = $this->render('EkynaDemoBundle:Catalog:product.html.twig', array(
            'product' => $product,
            'form' => $form->createView()
        ));

        return $this->configureSharedCache($response, $product->getEntityTags());
    }

    /**
     * Finds the current category.
     *
     * @param Request $request
     * @return \Ekyna\Bundle\DemoBundle\Entity\Category|null
     */
    private function findCategory(Request $request)
    {
        $categorySlug = $request->attributes->get('categorySlug');

        if (null === $category = $this->get('ekyna_demo.category.repository')->findBySlug($categorySlug)) {
            throw new NotFoundHttpException('Category not found.');
        }

        return $category;
    }

    /**
     * Finds the current product.
     *
     * @param Request $request
     * @return \Ekyna\Bundle\DemoBundle\Entity\Smartphone|null
     */
    private function findProduct(Request $request)
    {
        $productSlug = $request->attributes->get('productSlug');

        if(null === $product = $this->get('ekyna_demo.smartphone.repository')->findOneBy(array('slug' => $productSlug))) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $product;
    }
}
