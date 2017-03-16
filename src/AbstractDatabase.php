<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-database
 */

namespace Vainyl\Database;

use Vainyl\Connection\ConnectionInterface;
use Vainyl\Core\Id\AbstractIdentifiable;

/**
 * Class AbstractDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDatabase extends AbstractIdentifiable implements DatabaseInterface
{
    private $connection;

    private $connectionInstance = null;

    /**
     * AbstractDatabase constructor.
     *
     * @param ConnectionInterface               $connection
     */
    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return basename(get_class($this));
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        if (null === $this->connectionInstance) {
            $this->connectionInstance = $this->connection->establish();
        }

        return $this->connectionInstance;
    }
}
