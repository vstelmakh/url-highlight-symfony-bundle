<?php

namespace VStelmakh\TwigUrlHighlightBundle\Tests;

use PHPUnit\Framework\Assert;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwigUrlHighlightPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
        $twigExtensions = $container->findTaggedServiceIds('twig.extension');

        Assert::assertArrayHasKey(
            'vstelmakh.twig_url_highlight.twig_extension',
            $twigExtensions,
            'Service not found by tag: twig.extension'
        );
    }
}
