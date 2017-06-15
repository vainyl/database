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
use Vainyl\Core\Extension\AbstractFrameworkExtension;
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseExtension extends AbstractFrameworkExtension
{

    /**
     * @inheritDoc
     */
    public function getCompilerPasses(): array
    {
        return [new DatabaseCompilerPass()];
    }

    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        $configuration = new DatabaseConfiguration();
        $databases = $this->processConfiguration($configuration, $configs);

        foreach ($databases as $name => $config) {
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
                ->addTag('database', ['name' => $name]);
            $container->setDefinition('database.' . $name, $definition);
        }

        return parent::load($configs, $container);
    }
}