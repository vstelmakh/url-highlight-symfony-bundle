<?php

namespace VStelmakh\TwigUrlHighlightBundle\Tests;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use VStelmakh\TwigUrlHighlightBundle\TwigUrlHighlightBundle;

class SymfonyTestingKernel extends Kernel
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
}
