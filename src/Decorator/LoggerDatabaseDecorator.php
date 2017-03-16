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

namespace Vainyl\Database\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Database\CursorInterface;
use Vainyl\Database\DatabaseInterface;

/**
 * Class LoggerDatabaseDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerDatabaseDecorator extends AbstractDatabaseDecorator
{
    private $logger;

    /**
     * LoggerDatabaseDecorator constructor.
     *
     * @param DatabaseInterface $database
     * @param LoggerInterface   $logger
     */
    public function __construct(DatabaseInterface $database, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($database);
    }

    /**
     * @inheritDoc
     */
    public function runQuery($query, array $bindParams, array $bindTypes = []): CursorInterface
    {
        $this->logger->debug(sprintf('Executing query %s with parameters (%s)', $query, implode(', ', $bindParams)));
        $result = parent::runQuery($query, $bindParams, $bindTypes);
        $this->logger->debug(sprintf('Query returned %d results', $result->count()));

        return $result;
    }
}