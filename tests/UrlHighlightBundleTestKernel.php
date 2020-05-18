<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use VStelmakh\UrlHighlightSymfonyBundle\UrlHighlightBundle;

class UrlHighlightBundleTestKernel extends Kernel
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var array&array[]
     */
    private $services;

    /**
     * @var array&string[]
     */
    private $config;

    /**
     * @param array&array[] $services [service_id] => array[class, arguments...]
     * @param array&string[] $config
     * @param string $environment
     */
    public function __construct(array $services = [], array $config = [], string $environment = 'test')
    {
        $this->filesystem = new Filesystem();
        $this->services = $services;
        $this->config = $config;
        parent::__construct($environment, true);
    }

    public function __destruct()
    {
        $this->clearCache();
    }

    public function clearCache(): void
    {
        $cacheDir = $this->getCacheDir();
        $this->filesystem->remove($cacheDir);
    }

    /**
     * @return array&Bundle[]
     */
    public function registerBundles(): array
    {
        return [
            new UrlHighlightBundle(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(function (ContainerBuilder $container) {
            foreach ($this->services as $id => $args) {
                $class = array_shift($args);
                $container->setDefinition($id, new Definition($class, $args));
            }
        });

        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('url_highlight', $this->config);
        });

//        $loader->load(__DIR__ . '/url_highlight.yaml');
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new UrlHighlightBundlePass());
    }
}
