<?php

namespace VStelmakh\UrlHighlightSymfonyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        if ($this->isNewTreeBuilder()) {
            $treeBuilder = new TreeBuilder('url_highlight');
            $rootNode = $treeBuilder->getRootNode();
        } else {
            $treeBuilder = new TreeBuilder();
            $rootNode = $treeBuilder->root('url_highlight');
        }

        $rootNode
            ->children()
                ->scalarNode('validator')
                    ->info('Validator service id. Use: VStelmakh\UrlHighlight\Validator\ValidatorInterface to implement.')
                    ->defaultNull()
                ->end()
                ->scalarNode('highlighter')
                    ->info('Highlighter service id. Use: VStelmakh\UrlHighlight\Highlighter\HighlighterInterface to implement.')
                    ->defaultNull()
                ->end()
                ->scalarNode('encoder')
                    ->info('Encoder service id. Use: VStelmakh\UrlHighlight\Encoder\EncoderInterface to implement.')
                    ->defaultNull()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    /**
     * From version 4.2 TreeBuilder::root is deprecated
     * @return bool
     */
    private function isNewTreeBuilder(): bool
    {
        return method_exists(TreeBuilder::class, 'getRootNode');
    }
}
