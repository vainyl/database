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

namespace Vainyl\Database\Storage;

use Vainyl\Core\Id\Storage\AbstractIdentifiableStorage;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Database\Factory\DatabaseFactoryInterface;

/**
 * Class DatabaseStorage
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseStorage extends AbstractIdentifiableStorage
{
    private $databases = [];

    private $databaseFactory;

    /**
     * ConnectionStorage constructor.
     *
     * @param DatabaseFactoryInterface $databaseFactory
     */
    public function __construct(DatabaseFactoryInterface $databaseFactory)
    {
        $this->databaseFactory = $databaseFactory;
    }

    /**
     * @param string $alias
     *
     * @return DatabaseInterface
     */
    public function getConnection(string $alias): DatabaseInterface
    {
        if (false === array_key_exists($alias, $this->databases)) {
            $this->databases[$alias] = $this->databaseFactory->decorate($this->offsetGet($alias));
        }

        return $this->databases[$alias];
    }
}