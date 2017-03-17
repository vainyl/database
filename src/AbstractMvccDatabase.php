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

namespace Vainyl\Database;

use Vainyl\Database\Exception\LevelIntegrityException;

/**
 * Class AbstractMvccDatabase
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractMvccDatabase extends AbstractDatabase implements MvccDatabaseInterface
{
    private $level = 0;

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @return bool
     */
    abstract public function doStartTransaction(): bool;

    /**
     * @return bool
     */
    abstract public function doCommitTransaction(): bool;

    /**
     * @return bool
     */
    abstract public function doRollbackTransaction(): bool;

    /**
     * @inheritDoc
     */
    public function startTransaction(): bool
    {
        if (0 < $this->level) {
            $this->level++;

            return true;
        }

        if (0 > $this->level) {
            throw new LevelIntegrityException($this, $this->level);
        }

        return $this->doStartTransaction();
    }

    /**
     * @inheritDoc
     */
    public function commitTransaction(): bool
    {
        $this->level--;

        if (0 < $this->level) {
            return true;
        }

        if (0 > $this->level) {
            throw new LevelIntegrityException($this, $this->level);
        }

        return $this->doCommitTransaction();
    }

    /**
     * @inheritDoc
     */
    public function rollbackTransaction(): bool
    {
        $this->level--;

        if (0 < $this->level) {
            return true;
        }

        if (0 > $this->level) {
            throw new LevelIntegrityException($this, $this->level);
        }

        return $this->doRollbackTransaction();
    }
}