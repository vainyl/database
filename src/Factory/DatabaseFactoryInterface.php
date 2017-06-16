<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Database\Factory;

use Vainyl\Core\IdentifiableInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Interface DatabaseFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DatabaseFactoryInterface extends IdentifiableInterface
{
    /**
     * @param string $databaseName
     * @param string $connectionName
     * @param array  $options
     *
     * @return DatabaseInterface
     */
    public function createDatabase(
        string $databaseName,
        string $connectionName,
        array $options = []
    ): DatabaseInterface;
}