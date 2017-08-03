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

namespace Vainyl\Database\Operation;

use Vainyl\Core\AbstractSuccessfulResult;
use Vainyl\Database\CursorInterface;
use Vainyl\Operation\OperationInterface;

/**
 * Class DatabaseSuccessfulResult
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseSuccessfulResult extends AbstractSuccessfulResult
{
    private $cursor;

    private $operation;

    /**
     * DatabaseSuccessfulResult constructor.
     *
     * @param OperationInterface $operation
     * @param CursorInterface    $cursor
     */
    public function __construct(OperationInterface $operation, CursorInterface $cursor)
    {
        $this->operation = $operation;
        $this->cursor = $cursor;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(
            ['cursor' => $this->cursor->getAll(), 'operation' => $this->operation->getName()],
            parent::toArray()
        );
    }
}