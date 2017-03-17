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

namespace Vainyl\Database\Factory;

use Vainyl\Core\Id\AbstractIdentifiable;
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseFactory extends AbstractIdentifiable implements DatabaseFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function decorate(DatabaseInterface $database): DatabaseInterface
    {
        return $database;
    }
}
