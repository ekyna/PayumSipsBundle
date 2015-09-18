<?php

namespace Ekyna\Bundle\BlogBundle\Controller;

use Ekyna\Bundle\BlogBundle\Entity\Category;
use Ekyna\Bundle\BlogBundle\Entity\Post;
use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExampleController
 * @package Ekyna\Bundle\BlogBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ExampleController extends Controller
{
    /**
     * Renders the blog side content.
     *
     * @param integer $categoryId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sideAction($categoryId = null)
    {
        $categoryRepo = $this->get('ekyna_blog.category.repository');

        $category = null;
        $categoryId = intval($categoryId);
        if (0 < $categoryId) {
            /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface $category */
            $category = $categoryRepo->find($categoryId);
            if (null === $category) {
                throw new NotFoundHttpException('Category not found.');
            }
        }

        /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface[] $categories */
        $categories = $categoryRepo->findBy(['enabled' => true]);

        $postRepo = $this->get('ekyna_blog.post.repository');
        /** @var \Ekyna\Bundle\BlogBundle\Model\PostInterface[] $posts */
        $posts = $postRepo->findLatest($category);

        $response = $this->render('EkynaBlogBundle:Example:side.html.twig', array(
            'categories' => $categories,
            'category'   => $category,
            'posts'      => $posts,
        ));

        $tags = null !== $category ? $category->getEntityTags() : [];
        $tags[] = Category::getEntityTagPrefix();
        foreach ($categories as $category) {
            $tags[] = $category->getEntityTag();
        }
        foreach ($posts as $post) {
            $tags[] = $post->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Example index page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $categoryRepo = $this->get('ekyna_blog.category.repository');
        /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface[] $categories */
        $categories = $categoryRepo->findBy(['enabled' => true]);

        $currentPage = $request->query->get('page', 1);
        $postRepo = $this->get('ekyna_blog.post.repository');
        $pager = $postRepo->getPaginatedList($currentPage);
        /** @var \Ekyna\Bundle\BlogBundle\Model\PostInterface[] $posts */
        $posts = $pager->getCurrentPageResults();

        $response = $this->render('EkynaBlogBundle:Example:index.html.twig', array(
            'categories' => $categories,
            'pager'      => $pager,
            'posts'      => $posts,
        ));

        $tags = [Post::getEntityTagPrefix()];
        foreach ($categories as $category) {
            $tags[] = $category->getEntityTag();
        }
        foreach ($posts as $post) {
            $tags[] = $post->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Example category page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     */
    public function categoryAction(Request $request)
    {
        $categoryRepo = $this->get('ekyna_blog.category.repository');
        /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface $category */
        $category = $categoryRepo->findOneBySlug($request->attributes->get('categorySlug'));

        if (null === $category) {
            throw new NotFoundHttpException('Category not found.');
        }

        /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface[] $categories */
        $categories = $categoryRepo->findBy(['enabled' => true], ['name' => 'ASC']);

        $currentPage = $request->query->get('page', 1);
        $postRepo = $this->get('ekyna_blog.post.repository');
        $pager = $postRepo->getPaginatedList($currentPage, $category);
        /** @var \Ekyna\Bundle\BlogBundle\Model\PostInterface[] $posts */
        $posts = $pager->getCurrentPageResults();

        $response = $this->render('EkynaBlogBundle:Example:category.html.twig', array(
            'categories' => $categories,
            'category'   => $category,
            'pager'      => $pager,
            'posts'      => $posts,
        ));

        $tags = $category->getEntityTags();
        $tags[] = Category::getEntityTagPrefix();
        foreach ($categories as $category) {
            $tags[] = $category->getEntityTag();
        }
        foreach ($posts as $post) {
            $tags[] = $post->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Example post page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     */
    public function postAction(Request $request)
    {
        $categoryRepo = $this->get('ekyna_blog.category.repository');
        /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface $category */
        $category = $categoryRepo->findOneBySlug($request->attributes->get('categorySlug'));

        if (null === $category) {
            throw new NotFoundHttpException('Category not found.');
        }

        $postRepo = $this->get('ekyna_blog.post.repository');
        /** @var \Ekyna\Bundle\BlogBundle\Model\PostInterface $post */
        $post = $postRepo->findOneBySlug($request->attributes->get('postSlug'), $category);

        if (null === $category) {
            throw new NotFoundHttpException('$post not found.');
        }

        /** @var \Ekyna\Bundle\BlogBundle\Model\CategoryInterface[] $categories */
        $categories = $categoryRepo->findBy(['enabled' => true], ['name' => 'ASC']);

        $response = $this->render('EkynaBlogBundle:Example:post.html.twig', array(
            'categories' => $categories,
            'category'   => $category,
            'post'       => $post,
        ));

        $tags = $post->getEntityTags();
        foreach ($categories as $category) {
            $tags[] = $category->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }
}
