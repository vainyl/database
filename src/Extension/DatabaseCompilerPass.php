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
declare(strict_types = 1);

namespace Vainyl\Database\Extension;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Vainyl\Core\Extension\AbstractCompilerPass;
use Vainyl\Core\Extension\Exception\MissingRequiredFieldException;

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
            return $this;
        }

        $services = $container->findTaggedServiceIds('database');
        foreach ($services as $id => $tags) {
            foreach ($tags as $tag) {
                if (false === array_key_exists('alias', $tag)) {
                    throw new MissingRequiredFieldException($container, $id, $tag, 'alias');
                }
                $alias = $tag['alias'];
                $definition = $container->getDefinition($id);
                $inner = $id . '.inner';
                $container->setDefinition($inner, $definition);

                $containerDefinition = $container->getDefinition('database.storage');
                $containerDefinition
                    ->addMethodCall('addInstance', [$alias, new Reference($inner)]);

                $decoratedDefinition = (new Definition())
                    ->setFactory(['database.storage', 'getDatabase'])
                    ->setArguments($alias);

                $container->setDefinition($id, $decoratedDefinition);
            }
        }

        return $this;
    }
}
