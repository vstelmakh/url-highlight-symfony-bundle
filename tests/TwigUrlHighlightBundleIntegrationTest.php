<?php

namespace VStelmakh\TwigUrlHighlightBundle\Tests;

use PHPUnit\Framework\TestCase;
use VStelmakh\TwigUrlHighlight\UrlHighlightExtension;

class TwigUrlHighlightBundleIntegrationTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new TwigUrlHighlightTestingKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $twigUrlHighlight = $container->get('vstelmakh.twig_url_highlight.twig_extension');
        $this->assertInstanceOf(UrlHighlightExtension::class, $twigUrlHighlight);
    }
}
