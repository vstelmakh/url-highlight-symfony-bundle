<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use VStelmakh\UrlHighlightSymfonyBundle\UrlHighlightSymfonyBundle;

class UrlHighlightBundleTestingKernel extends Kernel
{
    /**
     * @return array|Bundle[]
     */
    public function registerBundles(): array
    {
        return [
            new UrlHighlightSymfonyBundle(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new UrlHighlightBundlePass());
    }
}
