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
                ->booleanNode('match_by_tld')
                    ->info('if true, will map matches without scheme by top level domain')
                    ->defaultTrue()
                ->end()
                ->scalarNode('default_scheme')
                    ->info('scheme to use when highlighting urls without scheme')
                    ->defaultValue('http')
                ->end()
                ->arrayNode('scheme_blacklist')
                    ->info('array of schemes not allowed to be recognized as url')
                    ->beforeNormalization()->ifString()->then(function ($value) {
                        return [$value];
                    })->end()
                    ->prototype('scalar')->end()
                    ->defaultValue([])
                ->end()
                ->arrayNode('scheme_whitelist')
                    ->info('array of schemes explicitly allowed to be recognized as url')
                    ->beforeNormalization()->ifString()->then(function ($value) {
                        return [$value];
                    })->end()
                    ->prototype('scalar')->end()
                    ->defaultValue([])
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
