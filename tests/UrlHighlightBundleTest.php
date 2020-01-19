<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use PHPUnit\Framework\TestCase;
use VStelmakh\UrlHighlight\UrlHighlight;
use VStelmakh\UrlHighlightTwigExtension\UrlHighlightExtension;

class UrlHighlightBundleTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new UrlHighlightBundleTestKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $twigUrlHighlight = $container->get('vstelmakh.url_highlight');
        $this->assertInstanceOf(UrlHighlight::class, $twigUrlHighlight);

        $twigUrlHighlight = $container->get('vstelmakh.url_highlight.twig_extension');
        $this->assertInstanceOf(UrlHighlightExtension::class, $twigUrlHighlight);
    }
}
