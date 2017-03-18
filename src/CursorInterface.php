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

/**
 * Interface CursorInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface CursorInterface extends \Countable, \Iterator
{
    /**
     * @return CursorInterface
     */
    public function close() : CursorInterface;

    /**
     * @param int $mode
     *
     * @return CursorInterface
     */
    public function mode(int $mode) : CursorInterface;

    /**
     * @return array
     */
    public function getSingle() : array;

    /**
     * @return array
     */
    public function getAll() : array;
}
