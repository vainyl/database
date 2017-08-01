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

namespace Vainyl\Database\Factory;

use Vainyl\Core\AbstractIdentifiable;
use Vainyl\Database\DatabaseInterface;

/**
 * Class DatabaseFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseDecorator extends AbstractIdentifiable implements DatabaseDecoratorInterface
{
    /**
     * @inheritDoc
     */
    public function decorate(DatabaseInterface $database): DatabaseInterface
    {
        return $database;
    }
}