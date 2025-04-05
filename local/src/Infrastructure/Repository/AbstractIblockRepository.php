<?php

namespace Otus\Local\Infrastructure\Repository;

use Bitrix\Iblock\Iblock;
use Bitrix\Iblock\IblockTable;
use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Query\Query;
use InvalidArgumentException;

abstract class AbstractIblockRepository
{
    protected DataManager $dataManager;
    protected string $iblockCode;

    public function __construct(string $iblockCode)
    {
        $this->iblockCode = $iblockCode;

        $iblockData = IblockTable::query()
            ->setSelect(['ID'])
            ->where('CODE', $iblockCode)
            ->setCacheTtl(86400)
            ->fetch();

        if (!$iblockData['ID']) {
            throw new InvalidArgumentException('Iblock is not exists');
        }

        $iblock = Iblock::wakeUp($iblockData['ID']);
        $className = $iblock->getEntityDataClass();

        if (!class_exists($className)) {
            throw new ArgumentException(sprintf('Class %s is not exists', $className));
        }

        $this->dataManager = new $className();
    }

    public function getDataClass(): DataManager|string
    {
        return $this->dataManager->getEntity()->getDataClass();
    }

    public function getQuery(): Query
    {
        return $this->dataManager::query();
    }
}
