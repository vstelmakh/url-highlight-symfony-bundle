<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use VStelmakh\UrlHighlightSymfonyBundle\UrlHighlightBundle;

class UrlHighlightBundleTestKernel extends Kernel
{
    /**
     * @return array|Bundle[]
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
        $loader->load(__DIR__ . '/url_highlight.yaml');
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new UrlHighlightBundlePass());
    }
}
