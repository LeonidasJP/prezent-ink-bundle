<?php

namespace Prezent\InkBundle\DependencyInjection\Compiler;

use Prezent\Inky\Inky;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Add inky components
 *
 * @see CompilerPassInterface
 * @author Sander Marechal
 */
class InkyComponentPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition(Inky::class);
        $taggedServices = $container->findTaggedServiceIds('prezent_ink.inky_component');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addComponentFactory', [new Reference($id)]);
        }
    }
}
