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

namespace Vainyl\Database\Factory\Decorator;

use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Factory\DatabaseDecoratorInterface;

/**
 * Class AbstractDatabaseFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDatabaseDecoratorDecorator implements DatabaseDecoratorInterface
{
    private $databaseDecorator;

    /**
     * AbstractDatabaseFactoryDecorator constructor.
     *
     * @param DatabaseDecoratorInterface $databaseDecorator
     */
    public function __construct(DatabaseDecoratorInterface $databaseDecorator)
    {
        $this->databaseDecorator = $databaseDecorator;
    }

    /**
     * @inheritDoc
     */
    public function decorate(DatabaseInterface $database): DatabaseInterface
    {
        return $this->databaseDecorator->decorate($database);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->databaseDecorator->getId();
    }
}
