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

namespace Vainyl\Database\Exception;

use Vainyl\Database\DatabaseInterface;

/**
 * Class LevelIntegrityException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LevelIntegrityException extends AbstractDatabaseException
{
    private $level;

    /**
     * LevelIntegrityException constructor.
     *
     * @param DatabaseInterface $database
     * @param int               $level
     */
    public function __construct(DatabaseInterface $database, int $level)
    {
        $this->level = $level;
        parent::__construct(
            $database,
            sprintf(
                'Trying to set prohibited level %d on database %s',
                $this->level,
                $database->getName()
            )
        );
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['level' => $this->level], parent::toArray());
    }
}
