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

/**
 * Interface MvccDatabaseInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface MvccDatabaseInterface extends DatabaseInterface
{
    /**
     * @return bool
     */
    public function startTransaction(): bool;

    /**
     * @return bool
     */
    public function commitTransaction(): bool;

    /**
     * @return bool
     */
    public function rollbackTransaction(): bool;
}
