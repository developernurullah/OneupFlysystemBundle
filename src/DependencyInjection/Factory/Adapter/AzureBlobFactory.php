<?php

declare(strict_types=1);

namespace Oneup\FlysystemBundle\DependencyInjection\Factory\Adapter;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\Reference;
use Oneup\FlysystemBundle\DependencyInjection\Factory\AdapterFactoryInterface;

class AzureBlobFactory implements AdapterFactoryInterface
{
    public function getKey(): string
    {
        return 'azureblob';
    }

    public function create(ContainerBuilder $container, $id, array $config): void
    {
        $definition = $container
            ->setDefinition($id, new ChildDefinition('oneup_flysystem.adapter.azureblob'))
            ->replaceArgument(0, new Reference($config['client']))
            ->replaceArgument(1, $config['container'])
            ->replaceArgument(2, $config['prefix'])
        ;
    }

    public function addConfiguration(NodeDefinition $node): void
    {
        $node
            ->children()
                ->scalarNode('client')->isRequired()->end()
                ->scalarNode('container')->isRequired()->end()
                ->scalarNode('prefix')->defaultNull()->end()
            ->end()
        ;
    }
}
