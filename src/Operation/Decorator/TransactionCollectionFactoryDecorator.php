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

use Vainyl\Database\MvccDatabaseInterface;
use Vainyl\Operation\Collection\CollectionInterface;
use Vainyl\Operation\Collection\Decorator\AbstractCollectionFactoryDecorator;
use Vainyl\Operation\Collection\Factory\CollectionFactoryInterface;

/**
 * Class EventCollectionFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class TransactionCollectionFactoryDecorator extends AbstractCollectionFactoryDecorator
{
    private $database;

    /**
     * EventCollectionFactoryDecorator constructor.
     *
     * @param CollectionFactoryInterface $collectionFactory
     * @param MvccDatabaseInterface      $database
     */
    public function __construct(CollectionFactoryInterface $collectionFactory, MvccDatabaseInterface $database)
    {
        $this->database = $database;
        parent::__construct($collectionFactory);
    }

    /**
     * @inheritDoc
     */
    public function create(array $operations = []): CollectionInterface
    {
        return new TransactionCollectionDecorator(parent::create($operations), $this->database);
    }
}