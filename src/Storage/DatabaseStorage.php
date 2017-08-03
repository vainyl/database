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
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseStorage extends AbstractStorageDecorator
{
    /**
     * @param string            $alias
     * @param DatabaseInterface $database
     *
     * @return $this
     */
    public function addDatabase(string $alias, DatabaseInterface $database)
    {
        $this->offsetSet($alias, $database);

        return $this;
    }

    /**
     * @param string $alias
     *
     * @return DatabaseInterface
     */
    public function getDatabase(string $alias): DatabaseInterface
    {
        return $this->offsetGet($alias);
    }
}
