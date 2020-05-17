<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use VStelmakh\UrlHighlight\Encoder\HtmlSpecialcharsEncoder;
use VStelmakh\UrlHighlight\Highlighter\HtmlHighlighter;
use VStelmakh\UrlHighlight\UrlHighlight;
use VStelmakh\UrlHighlight\Validator\Validator;
use VStelmakh\UrlHighlightTwigExtension\UrlHighlightExtension;

class UrlHighlightBundleTest extends TestCase
{
    public function tearDown(): void
    {
        $this->clearCache();
    }

    public function testServiceWiring(): void
    {
        $kernel = new UrlHighlightBundleTestKernel();
        $kernel->boot();
        $container = $kernel->getContainer();

        $urlHighlight = $container->get('vstelmakh.url_highlight');
        $this->assertInstanceOf(UrlHighlight::class, $urlHighlight);

        if (Kernel::MAJOR_VERSION > 3) { // unable to change service definition to public in old DI component
            $twigUrlHighlight = $container->get('vstelmakh.url_highlight.twig_extension');
            $this->assertInstanceOf(UrlHighlightExtension::class, $twigUrlHighlight);
        }
    }

    /**
     * @dataProvider configDataProvider
     *
     * @param array&array[] $services
     * @param array&string[] $config
     * @param string $input
     * @param string $expected
     */
    public function testConfig(array $services, array $config, string $input, string $expected): void
    {
        $kernel = new UrlHighlightBundleTestKernel($services, $config);
        $kernel->boot();
        $container = $kernel->getContainer();

        /** @var UrlHighlight $urlHighlight */
        $urlHighlight = $container->get('vstelmakh.url_highlight');
        $actual = $urlHighlight->highlightUrls($input);
        $this->assertSame($expected, $actual);
    }

    /**
     * @return array&array[]
     */
    public function configDataProvider(): array
    {
        return [
            'default behaviour' => [
                [],
                [],
                'example.com',
                '<a href="http://example.com">example.com</a>',
            ],
            'custom validator' => [
                [
                    'test.validator' => [Validator::class, false]
                ],
                [
                    'validator' => 'test.validator',
                ],
                'example.com',
                'example.com',
            ],
            'custom highlighter' => [
                [
                    'test.highlighter' => [HtmlHighlighter::class, 'https']
                ],
                [
                    'highlighter' => 'test.highlighter',
                ],
                'example.com',
                '<a href="https://example.com">example.com</a>',
            ],
            'custom encoder' => [
                [
                    'test.encoder' => [HtmlSpecialcharsEncoder::class]
                ],
                [
                    'encoder' => 'test.encoder',
                ],
                '&lt;p:gt;example.com&lt;/p:gt;',
                '&lt;p:gt;<a href="http://example.com">example.com</a>&lt;/p:gt;',
            ],
        ];
    }

    private function clearCache(): void
    {
        $filesystem = new Filesystem();
        $kernel = new UrlHighlightBundleTestKernel();
        $cacheDir = $kernel->getCacheDir();
        $filesystem->remove($cacheDir);
    }
}
