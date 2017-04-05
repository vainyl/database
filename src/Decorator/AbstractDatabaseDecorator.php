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

namespace Vainyl\Database\Decorator;

use Vainyl\Database\CursorInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Class AbstractDatabaseDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDatabaseDecorator implements DatabaseInterface
{
    private $database;

    /**
     * AbstractDatabaseDecorator constructor.
     *
     * @param DatabaseInterface $database
     */
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []): CursorInterface
    {
        return $this->database->runQuery($query, $bindParams, $bindTypes);
    }

    /**
     * @inheritDoc
     */
    public function getId(): string
    {
        return $this->database->getId();
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->database->getName();
    }
}
