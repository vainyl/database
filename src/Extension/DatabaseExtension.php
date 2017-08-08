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
use Vainyl\Core\Exception\MissingRequiredServiceException;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\AbstractFrameworkExtension;
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseExtension extends AbstractFrameworkExtension
{
    const DECORATORS = [
        'collection.factory.set.transaction',
        'collection.factory.sequence.transaction',
    ];

    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [[new DatabaseCompilerPass()]];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        parent::load($configs, $container);

        foreach (self::DECORATORS as $requiredService) {
            if (false === $container->has($requiredService)) {
                throw new  MissingRequiredServiceException($container, $requiredService);
            }
        }

        $configuration = new DatabaseConfiguration();
        $databases = $this->processConfiguration($configuration, $configs);

        foreach ($databases as $name => $config) {
            $databaseId = 'database.' . $name;
            $factoryId = 'database.factory.' . $config['driver'];
            $definition = (new Definition())
                ->setClass(DatabaseInterface::class)
                ->setFactory([new Reference($factoryId), 'createDatabase'])
                ->setArguments(
                    [
                        $name,
                        $config['connection'],
                        $config['options'],
                    ]
                )
                ->addTag('database', ['alias' => $name])
                ->addTag('database.' . $config['driver'], ['alias' => $name]);
            $container->setDefinition($databaseId, $definition);
            if (false === $config['mvcc']) {
                continue;
            }
            foreach (self::DECORATORS as $decorator) {
                $definition = clone $container->findDefinition($decorator);
                $serviceId = $decorator . '.' . $databaseId;
                $definition->replaceArgument(0, new Reference($serviceId . '.inner'));
                $definition->replaceArgument(1, new Reference($databaseId));
                $container->setDefinition($serviceId, $definition);
            }
        }

        foreach (self::DECORATORS as $decorator) {
            $container->removeDefinition($decorator);
        }

        return $this;
    }
}