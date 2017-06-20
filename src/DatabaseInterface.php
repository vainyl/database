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

use Vainyl\Core\NameableInterface;

/**
 * Interface DatabaseInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DatabaseInterface extends NameableInterface
{
    /**
     * @param mixed $query
     * @param array $bindParams
     * @param array $bindTypes
     *
     * @return CursorInterface
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []): CursorInterface;
}
