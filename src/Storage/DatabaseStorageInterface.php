<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types = 1);
namespace Vainyl\Database\Storage;

use Vainyl\Core\Storage\StorageInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DatabaseStorageInterface extends StorageInterface
{
    /**
     * @param string $alias
     *
     * @return DatabaseInterface
     */
    public function getConnection(string $alias): DatabaseInterface;
}
