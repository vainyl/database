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

namespace Vainyl\Database\Factory\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Decorator\LoggerDatabaseDecorator;
use Vainyl\Database\Factory\DatabaseFactoryInterface;

/**
 * Class LoggerDatabaseFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerDatabaseFactoryDecorator extends AbstractDatabaseFactoryDecorator
{
    private $logger;

    /**
     * @inheritDoc
     */
    public function __construct(DatabaseFactoryInterface $databaseFactory, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($databaseFactory);
    }

    /**
     * @inheritDoc
     */
    public function decorate(DatabaseInterface $database): DatabaseInterface
    {
        return new LoggerDatabaseDecorator(parent::decorate($database), $this->logger);
    }
}
