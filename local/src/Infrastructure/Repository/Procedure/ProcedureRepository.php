<?php

namespace Otus\Local\Infrastructure\Repository\Procedure;

use Bitrix\Iblock\Iblock;
use Bitrix\Iblock\IblockTable;
use InvalidArgumentException;
use Otus\Local\Infrastructure\Repository\AbstractIblockRepository;

class ProcedureRepository extends AbstractIblockRepository
{
    public function __construct()
    {
        parent::__construct('procedure');
    }
}
