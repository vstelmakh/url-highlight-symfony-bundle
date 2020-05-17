<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class UrlHighlightExtension extends Extension
{
    /**
     * @param array|array[] $configs
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        /** @var ConfigurationInterface $configuration */
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $validator = $this->getServiceReference($config['validator']);
        $highlighter = $this->getServiceReference($config['highlighter']);
        $encoder = $this->getServiceReference($config['encoder']);

        $definition = $container->getDefinition('vstelmakh.url_highlight');
        $definition->setArguments([$validator, $highlighter, $encoder]);
    }

    /**
     * @param string|null $id
     * @return Reference|null
     */
    private function getServiceReference(?string $id): ?Reference
    {
        return empty($id) ? null : new Reference($id);
    }
}
