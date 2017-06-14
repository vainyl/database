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

namespace Vainyl\Database\Factory\Decorator;

use Psr\Log\LoggerInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Decorator\LoggerDatabaseDecorator;
use Vainyl\Database\Factory\DatabaseDecoratorInterface;

/**
 * Class LoggerDatabaseFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class LoggerDatabaseFactoryDecorator extends AbstractDatabaseDecoratorDecorator
{
    private $logger;

    /**
     * @inheritDoc
     */
    public function __construct(DatabaseDecoratorInterface $databaseDecorator, LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct($databaseDecorator);
    }

    /**
     * @inheritDoc
     */
    public function decorate(DatabaseInterface $database): DatabaseInterface
    {
        return new LoggerDatabaseDecorator(parent::decorate($database), $this->logger);
    }
}
