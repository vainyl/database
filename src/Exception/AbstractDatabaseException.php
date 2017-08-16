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

namespace Vainyl\Database\Exception;

use Vainyl\Core\Exception\AbstractCoreException;
use Vainyl\Database\DatabaseInterface;

/**
 * Class AbstractDatabaseException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
abstract class AbstractDatabaseException extends AbstractCoreException implements DatabaseExceptionInterface
{
    private $database;

    /**
     * AbstractDatabaseException constructor.
     *
     * @param DatabaseInterface $database
     * @param string            $message
     * @param int               $code
     * @param \Throwable|null   $previous
     */
    public function __construct(
        DatabaseInterface $database,
        string $message,
        int $code = 500,
        \Throwable $previous = null
    ) {
        $this->database = $database;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @inheritDoc
     */
    public function getDatabase(): DatabaseInterface
    {
        return $this->database;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return array_merge(['database' => $this->database->getName()], parent::toArray());
    }
}
