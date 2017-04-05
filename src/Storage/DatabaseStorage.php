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

use Ds\Map;
use Vainyl\Core\Storage\Proxy\AbstractStorageProxy;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Factory\DatabaseFactoryInterface;

/**
 * Class DatabaseStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseStorage extends AbstractStorageProxy
{
    private $databaseFactory;

    /**
     * DatabaseStorage constructor.
     *
     * @param Map                      $storage
     * @param DatabaseFactoryInterface $databaseFactory
     */
    public function __construct(Map $storage, DatabaseFactoryInterface $databaseFactory)
    {
        $this->databaseFactory = $databaseFactory;
        parent::__construct($storage);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->databaseFactory->decorate(parent::offsetGet($offset));
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
