<?php

namespace Ekyna\Bundle\SitemapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class SitemapController
 * @package Ekyna\Bundle\SitemapBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class SitemapController extends Controller
{
    /**
     * Renders the sitemaps index.
     *
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $registry = $this->get('ekyna_sitemap.provider_registry');
        $sitemaps = [];

        $lastUpdateDate = null;
        foreach($registry->getSitemaps() as $sitemap) {
            $providers = $registry->getProvidersBySitemap($sitemap);
            $sitemapLastUpdateDate = null;
            /** @var \Ekyna\Bundle\SitemapBundle\Provider\ProviderInterface $provider */
            foreach ($providers as $provider) {
                if (null === $sitemapLastUpdateDate || $sitemapLastUpdateDate < $provider->getLastUpdateDate()) {
                    $sitemapLastUpdateDate = $provider->getLastUpdateDate();
                }
            }
            $sitemaps[$sitemap] = $sitemapLastUpdateDate;
            if (null === $lastUpdateDate || $lastUpdateDate < $sitemapLastUpdateDate) {
                $lastUpdateDate = $sitemapLastUpdateDate;
            }
        }

        $response = new Response();
        $response->setLastModified($lastUpdateDate);
        $response->setPublic();
        if ($response->isNotModified($request)) {
            return $response;
        }
        $response->setMaxAge($this->container->getParameter('ekyna_sitemap.index_ttl'));
        $response->headers->add(array('Content-Type' => 'application/xml; charset=UTF-8'));

        return $response->setContent($this->renderView('EkynaSitemapBundle:Sitemap:index.xml.twig', array(
            'sitemaps' => $sitemaps,
        )));
    }

    /**
     * Renders the sitemap.
     *
     * @return Response
     */
    public function sitemapAction(Request $request)
    {
        $sitemap = $request->attributes->get('sitemap', null);

        $registry = $this->get('ekyna_sitemap.provider_registry');
        $providers = $registry->getProvidersBySitemap($sitemap);

        if (0 === count($providers)) {
            throw new NotFoundHttpException('Sitemap not found.');
        }

        $lastUpdateDate = null;
        /** @var \Ekyna\Bundle\SitemapBundle\Provider\ProviderInterface $provider */
        foreach($providers as $provider) {
            if (null === $lastUpdateDate || $lastUpdateDate < $provider->getLastUpdateDate()) {
                $lastUpdateDate = $provider->getLastUpdateDate();
            }
        }

        $response = new Response();
        $response->setLastModified($lastUpdateDate);
        $response->setPublic();
        if ($response->isNotModified($request)) {
            return $response;
        }
        $response->setMaxAge($this->container->getParameter('ekyna_sitemap.sitemap_ttl'));
        $response->headers->add(array('Content-Type' => 'application/xml; charset=UTF-8'));

        return $response->setContent($this->renderView('EkynaSitemapBundle:Sitemap:sitemap.xml.twig', array(
            'providers' => $providers,
        )));
    }
}
