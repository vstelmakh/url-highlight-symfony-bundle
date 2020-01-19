<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use PHPUnit\Framework\TestCase;
use VStelmakh\UrlHighlight\UrlHighlight;

class UrlHighlightBundleTest extends TestCase
{
    public function testServiceWiring(): void
    {
        $kernel = new UrlHighlightBundleTestKernel('test', true);
        $kernel->boot();
        $container = $kernel->getContainer();

        $twigUrlHighlight = $container->get('vstelmakh.url_highlight');
        $this->assertInstanceOf(UrlHighlight::class, $twigUrlHighlight);
    }
}
