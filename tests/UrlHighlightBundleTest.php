<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Kernel;
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

        if (Kernel::MAJOR_VERSION > 3) { // unable to change service definition to public in old DI component
            $twigUrlHighlight = $container->get('vstelmakh.url_highlight.twig_extension');
            $this->assertInstanceOf(UrlHighlightExtension::class, $twigUrlHighlight);
        }
    }
}
