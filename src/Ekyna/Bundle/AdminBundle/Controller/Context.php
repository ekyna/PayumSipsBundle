<?php

namespace Ekyna\Bundle\AdminBundle\Controller;

use Ekyna\Bundle\AdminBundle\Pool\ConfigurationInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Context
 * @package Ekyna\Bundle\AdminBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class Context
{
    /**
     * @var ConfigurationInterface
     */
    protected $config;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $resources;

    /**
     * Constructor.
     *
     * @param ConfigurationInterface $config
     * @param Request                $request
     */
    public function __construct(ConfigurationInterface $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;

        $this->resources = array();
    }

    /**
     * Returns the configuration.
     *
     * @return ConfigurationInterface
     */
    public function getConfiguration()
    {
        return $this->config;
    }

    /**
     * Returns the request.
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Adds the resource.
     *
     * @param string $name
     * @param object $resource
     * @return Context
     */
    public function addResource($name, $resource)
    {
        $this->resources[$name] = $resource;

        return $this;
    }

    /**
     * Returns a resource by name.
     *
     * @param string $name
     * @return object|null
     */
    public function getResource($name = null)
    {
        if (null === $name) {
            $name = $this->config->getResourceName();
        }
        if (isset($this->resources[$name])) {
            return $this->resources[$name];
        }
        return null;
    }

    /**
     * Returns the identifiers.
     *
     * @param bool $with_current
     * @return array
     */
    public function getIdentifiers($with_current = false)
    {
        $identifiers = array();
        foreach ($this->resources as $name => $resource) {
            if (!(!$with_current && $name === $this->config->getResourceName())) {
                $identifiers[$name . 'Id'] = $resource->getId();
            }
        }
        return $identifiers;
    }

    /**
     * Returns the template resources vars.
     *
     * @param array $extra
     * @throws \RuntimeException
     * @return array
     */
    public function getTemplateVars(array $extra = array())
    {
        $extraKeys = array_keys($extra);
        if (0 < count($extraKeys)) {
            foreach (array_keys($this->resources) as $key) {
                if (array_key_exists($key, $extraKeys)) {
                    throw new \RuntimeException(sprintf('Key "%s" used in extra template vars overrides a resource key.', $key));
                }
            }
            foreach (array('identifiers', 'resource_name', 'resource_id', 'route_prefix') as $key) {
                if (array_key_exists($key, $extraKeys)) {
                    throw new \RuntimeException(sprintf('Key "%s" is reserved and cannot be used in extra template vars.', $key));
                }
            }
        }

        return array_merge($this->resources, array(
            'identifiers'   => $this->getIdentifiers(),
            'resource_name' => $this->config->getResourceName(),
            'resource_id'   => $this->config->getId(),
            'route_prefix'  => $this->config->getRoutePrefix(),
            'form_template' => $this->config->getTemplate('_form.html'),
        ), $extra);
    }
}
