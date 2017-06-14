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

namespace Vainyl\Database\Storage;

use Vainyl\Core\Storage\Decorator\AbstractStorageDecorator;
use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Factory\DatabaseDecoratorInterface;

/**
 * Class DatabaseStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseStorage extends AbstractStorageDecorator
{
    private $databaseFactory;

    /**
     * DatabaseStorage constructor.
     *
     * @param StorageInterface           $storage
     * @param DatabaseDecoratorInterface $databaseFactory
     */
    public function __construct(StorageInterface $storage, DatabaseDecoratorInterface $databaseFactory)
    {
        $this->databaseFactory = $databaseFactory;
        parent::__construct($storage);
    }

    /**
     * @param string            $alias
     * @param DatabaseInterface $database
     *
     * @return $this
     */
    public function addDatabase(string $alias, DatabaseInterface $database)
    {
        $this->offsetSet($alias, $this->databaseFactory->decorate($database));

        return $this;
    }

    /**
     * @param string $alias
     *
     * @return DatabaseInterface
     */
    public function getConnection(string $alias): DatabaseInterface
    {
        return $this->offsetGet($alias);
    }
}
