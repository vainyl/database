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
use Vainyl\Core\Extension\AbstractExtension;
use Vainyl\Core\Extension\Exception\MissingRequiredFieldException;

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
        $container
            ->addCompilerPass(new DatabaseCompilerPass());

        foreach ($configs as $config) {
            if (false === array_key_exists('databases', $config)) {
                continue;
            }

            foreach ($config['databases'] as $name => $configData) {
                if (false === array_key_exists('connection', $configData)) {
                    throw new MissingRequiredFieldException($container, $name, $configData, 'connection');
                }
                $definition = (new Definition())
                    ->setFactory(['database.factory.' . $configData['driver'], 'createDatabase'])
                    ->setArguments([$name, $configData])
                    ->addTag('database');

                $container->setDefinition('database.' . $name, $definition);
            }
        }

        return parent::load($configs, $container);
    }
}
