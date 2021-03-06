<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Database\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Exception\MissingRequiredFieldException;
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractCompilerPass;
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseCompilerPass
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseCompilerPass extends AbstractCompilerPass
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (false === ($container->hasDefinition('database.storage'))) {
            throw new MissingRequiredServiceException($container, 'database.storage');
        }

        $services = $container->findTaggedServiceIds('database');
        foreach ($services as $id => $tags) {
            foreach ($tags as $attributes) {
                if (false === array_key_exists('alias', $attributes)) {
                    throw new MissingRequiredFieldException($container, $id, $attributes, 'alias');
                }
                $name = $attributes['alias'];
                $definition = $container->getDefinition($id);
                $inner = $id . '.inner';
                $container->setDefinition($inner, $definition);

                $containerDefinition = $container->getDefinition('database.storage');
                $containerDefinition
                    ->addMethodCall('addDatabase', [$name, new Reference($inner)]);

                $decoratedDefinition = (new Definition())
                    ->setClass(DatabaseInterface::class)
                    ->setFactory([new Reference('database.storage'), 'getDatabase'])
                    ->setArguments([$name]);

                $container->setDefinition($id, $decoratedDefinition);
            }
        }

        return $this;
    }
}
