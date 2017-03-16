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

namespace Vainyl\Database;

/**
 * Class AbstractMvccDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class AbstractMvccDatabase implements MvccDatabaseInterface
{
    private $level;

    /**
     * @return bool
     */
    abstract public function doStartTransaction() : bool;

    /**
     * @return bool
     */
    abstract public function doCommitTransaction() : bool;

    /**
     * @return bool
     */
    abstract public function doRollbackTransaction() : bool;


    /**
     * @inheritDoc
     */
    public function startTransaction(): bool
    {
        trigger_error('Method startTransaction is not implemented', E_USER_ERROR);
    }

    /**
     * @inheritDoc
     */
    public function commitTransaction(): bool
    {
        trigger_error('Method commitTransaction is not implemented', E_USER_ERROR);
    }

    /**
     * @inheritDoc
     */
    public function rollbackTransaction(): bool
    {
        trigger_error('Method rollbackTransaction is not implemented', E_USER_ERROR);
    }
}