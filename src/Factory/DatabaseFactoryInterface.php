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

namespace Vainyl\Database\Factory;

use Vainyl\Core\Id\IdentifiableInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Interface DatabaseFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DatabaseFactoryInterface extends IdentifiableInterface
{
    /**
     * @param DatabaseInterface $database
     *
     * @return DatabaseInterface
     */
    public function decorate(DatabaseInterface $database) : DatabaseInterface;
}