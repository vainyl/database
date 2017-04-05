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

namespace Vainyl\Database\Factory\Decorator;

use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Factory\DatabaseFactoryInterface;

/**
 * Class AbstractDatabaseFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDatabaseFactoryDecorator implements DatabaseFactoryInterface
{
    private $databaseFactory;

    /**
     * AbstractDatabaseFactoryDecorator constructor.
     *
     * @param DatabaseFactoryInterface $databaseFactory
     */
    public function __construct(DatabaseFactoryInterface $databaseFactory)
    {
        $this->databaseFactory = $databaseFactory;
    }

    /**
     * @inheritDoc
     */
    public function decorate(DatabaseInterface $database): DatabaseInterface
    {
        return $this->databaseFactory->decorate($database);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->databaseFactory->getId();
    }
}
