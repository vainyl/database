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
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseExtension
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseExtension extends AbstractExtension
{
    /**
     * @inheritDoc
     */
    public function load(array $configs, ContainerBuilder $container): AbstractExtension
    {
        $configuration = new DatabaseConfiguration();
        $databases = $this->processConfiguration($configuration, $configs);

        foreach ($databases as $name => $config) {
            $factoryId = 'database.factory.' . $config['driver'];
            if (false === $container->hasDefinition($factoryId)) {
                throw new MissingRequiredServiceException($container, $factoryId);
            }
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

        $container
            ->addCompilerPass(new DatabaseCompilerPass());

        parent::load($configs, $container);
    }
}