<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Event
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Database\Operation\Decorator;

use Vainyl\Core\ResultInterface;
use Vainyl\Database\MvccDatabaseInterface;
use Vainyl\Operation\Collection\CollectionInterface;
use Vainyl\Operation\Collection\Decorator\AbstractCollectionDecorator;

/**
 * Class TransactionCollectionDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TransactionCollectionDecorator extends AbstractCollectionDecorator
{
    private $database;

    /**
     * DoctrineCollectionDecorator constructor.
     *
     * @param CollectionInterface   $collection
     * @param MvccDatabaseInterface $database
     */
    public function __construct(CollectionInterface $collection, MvccDatabaseInterface $database)
    {
        $this->database = $database;
        parent::__construct($collection);
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        $this->database->startTransaction();
        $result = parent::execute();
        if (false === $result->isSuccessful()) {
            $this->database->rollbackTransaction();

            return $result;
        }
        $this->database->commitTransaction();

        return $result;
    }
}