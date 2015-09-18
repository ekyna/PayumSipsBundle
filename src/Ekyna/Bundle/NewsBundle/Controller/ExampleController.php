<?php

namespace Ekyna\Bundle\NewsBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Ekyna\Bundle\NewsBundle\Entity\News;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExampleController
 * @package Ekyna\Bundle\NewsBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ExampleController extends Controller
{
    /**
     * Example index page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $currentPage = $request->query->get('page', 1);

        $pager = $this
            ->get('ekyna_news.news.repository')
            ->createFrontPager($currentPage, 12)
        ;

        /** @var News[] $news */
        $news = $pager->getCurrentPageResults();

        $response = $this->render('EkynaNewsBundle:Example:index.html.twig', array(
            'pager' => $pager,
            'news'  => $news,
        ));

        $tags = [News::getEntityTagPrefix()];
        foreach ($news as $n) {
            $tags[] = $n->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }

    /**
     * Example detail page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException
     */
    public function detailAction(Request $request)
    {
        $repo = $this->get('ekyna_news.news.repository');

        $news = $repo->findOneBySlug($request->attributes->get('slug'));

        if (null === $news) {
            throw new NotFoundHttpException('News not found.');
        }

        $latest = $repo->findLatest()->getIterator();

        $response = $this->render('EkynaNewsBundle:Example:detail.html.twig', array(
            'news' => $news,
            'latest' => $latest,
        ));

        $tags = [News::getEntityTagPrefix(), $news->getEntityTag()];
        foreach ($latest as $l) {
            $tags[] = $l->getEntityTag();
        }

        return $this->configureSharedCache($response, $tags);
    }
}
