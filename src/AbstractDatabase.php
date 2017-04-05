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
    private $name;

    private $connection;

    private $connectionInstance = null;

    /**
     * AbstractDatabase constructor.
     *
     * @param string              $name
     * @param ConnectionInterface $connection
     */
    public function __construct(string $name, ConnectionInterface $connection)
    {
        $this->name = $name;
        $this->connection = $connection;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
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
