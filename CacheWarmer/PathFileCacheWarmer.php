<?php

namespace Ekyna\Bundle\PayumSipsBundle\CacheWarmer;

use Symfony\Component\HttpKernel\CacheWarmer\CacheWarmerInterface;

/**
 * Class PathFileCacheWarmer
 * @package Ekyna\Bundle\PayumSipsBundle\CacheWarmer
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class PathFileCacheWarmer implements CacheWarmerInterface
{
    /**
     * @var array
     */
    private $pathfileConfig;

    /**
     * @var array
     */
    private $clientConfig;

    /**
     * @var string
     */
    private $rootDir;


    /**
     * Constructor.
     *
     * @param array  $pathfileConfig
     * @param array  $clientConfig
     * @param string $rootDir
     */
    public function __construct(array $pathfileConfig, array $clientConfig, $rootDir)
    {
        $this->pathfileConfig  = $pathfileConfig;
        $this->clientConfig    = $clientConfig;
        $this->rootDir         = $rootDir;
    }

    /**
     * {@inheritdoc}
     */
    public function warmUp($cacheDir)
    {
        $dir = $cacheDir.DIRECTORY_SEPARATOR.'ekyna_payum_sips';
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $path = $dir.DIRECTORY_SEPARATOR.'pathfile';
        if (file_exists($path)) {
            unlink($path);
        }

        file_put_contents($path, $this->buildPathFileContent());
    }

    /**
     * Builds the pathfile content.
     *
     * @return string
     */
    private function buildPathFileContent()
    {
        $content = '';

        foreach ($this->pathfileConfig as $key => $value) {
            $param = null;
            if (in_array($key, array('f_default', 'f_param', 'f_certificate'))) {
                $param = $this->rootDir . DIRECTORY_SEPARATOR . trim($value, DIRECTORY_SEPARATOR);

                if ($key == 'f_param') {
                    $file = sprintf('%s.%s', $param, $this->clientConfig['merchant_id']);
                } elseif ($key == 'f_certificate') {
                    $file = sprintf(
                        '%s.%s.%s.%s',
                        $param,
                        $this->clientConfig['merchant_country'],
                        $this->clientConfig['merchant_id'],
                        $this->pathfileConfig['f_ctype']
                    );
                } else {
                    $file = $param;
                }

                if (!file_exists($file)) {
                    throw new \InvalidArgumentException("File '{$file}' does not exist (ekyna_payum_sips.pathfile.{$key} configuration).");
                } elseif (!is_readable($file)) {
                    throw new \InvalidArgumentException("File '{$file}' is not readable (ekyna_payum_sips.pathfile.{$key} configuration).");
                }
            } elseif ($key == 'd_logo') {
                $param = sprintf('/%s/', trim($value, '/'));
            } elseif ($key == 'f_ctype') {
                $param = $value;
            } elseif ($key == 'debug') {
                $param = $value ? 'YES' : 'NO';
            } else {
                throw new \RuntimeException("Unexpected configuration key '{$key}' (ekyna_payum_sips.pathfile).");
            }

            $content .= sprintf("%s!%s!".PHP_EOL, strtoupper($key), $param);
        }

        return $content;
    }

    /**
     * {@inheritdoc}
     */
    public function isOptional()
    {
        return false;
    }
}
