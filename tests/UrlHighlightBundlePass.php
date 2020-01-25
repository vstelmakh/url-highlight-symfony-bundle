<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use PHPUnit\Framework\Assert;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class UrlHighlightBundlePass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $containerBuilder): void
    {
        $twigExtensions = $containerBuilder->findTaggedServiceIds('twig.extension');

        Assert::assertArrayHasKey(
            'vstelmakh.url_highlight.twig_extension',
            $twigExtensions,
            'Service not found by tag: twig.extension'
        );

        $this->makeServicesPublic($containerBuilder);
    }

    /**
     * Gives ability to test private services
     *
     * @param ContainerBuilder $containerBuilder
     */
    private function makeServicesPublic(ContainerBuilder $containerBuilder): void
    {
        foreach ($containerBuilder->getDefinitions() as $definition) {
            $definition->setPublic(true);
        }

        foreach ($containerBuilder->getAliases() as $definition) {
            $definition->setPublic(true);
        }
    }
}
