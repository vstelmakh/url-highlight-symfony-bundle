<?php

namespace VStelmakh\TwigUrlHighlightBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use VStelmakh\TwigUrlHighlightBundle\TwigUrlHighlightBundle;

class TwigUrlHighlightTestingKernel extends Kernel
{
    /**
     * @inheritDoc
     */
    public function registerBundles()
    {
        return [
            new TwigUrlHighlightBundle(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
    }

    /**
     * @inheritDoc
     */
    protected function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TwigUrlHighlightPass());
    }
}
