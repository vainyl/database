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

namespace Vainyl\Database\Exception;

use Vainyl\Core\ArrayX\ArrayInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Interface DatabaseExceptionInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DatabaseExceptionInterface extends ArrayInterface, \Throwable
{
    /**
     * @return DatabaseInterface
     */
    public function getDatabase() : DatabaseInterface;
}
