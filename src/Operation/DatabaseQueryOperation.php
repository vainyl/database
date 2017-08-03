<?php
/**
 * Vainyl
 *
 * PHP Version 7
 *
 * @package   Database
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://vainyl.com
 */
declare(strict_types=1);

namespace Vainyl\Database\Operation;

use Vainyl\Core\ResultInterface;
use Vainyl\Database\DatabaseInterface;
use Vainyl\Operation\AbstractOperation;

/**
 * Class DatabaseQueryOperation
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DatabaseQueryOperation extends AbstractOperation
{
    private $database;

    private $query;

    private $bindParams;

    private $bindTypes;

    /**
     * DatabaseQueryOperation constructor.
     *
     * @param DatabaseInterface $database
     * @param string            $query
     * @param array             $bindParams
     * @param array             $bindTypes
     */
    public function __construct(
        DatabaseInterface $database,
        string $query,
        array $bindParams = [],
        array $bindTypes = []
    ) {
        $this->database = $database;
        $this->query = $query;
        $this->bindParams = $bindParams;
        $this->bindTypes = $bindTypes;
    }

    /**
     * @inheritDoc
     */
    public function execute(): ResultInterface
    {
        return new DatabaseSuccessfulResult(
            $this,
            $this->database->runQuery($this->query, $this->bindParams, $this->bindTypes)
        );
    }
}