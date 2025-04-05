<?php

namespace Otus\Local\Infrastructure\Repository;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Query\Query;

abstract class AbstractRepository
{
    protected DataManager $dataManager;

    public function __construct(string $className)
    {
        if (!class_exists($className)) {
            throw new ArgumentException(sprintf('Class %s is not exists', $className));
        }

        $this->dataManager = new $className();
    }

    public function getQuery(): Query
    {
        return $this->dataManager::query();
    }

    public function getDataManager(): DataManager
    {
        return $this->dataManager;
    }

    public function getEntity(): \Bitrix\Main\ORM\Entity
    {
        return $this->dataManager->getEntity();
    }

    public function getTableName(): string
    {
        return $this->getEntity()->getDBTableName();
    }

    public function getConnection(): \Bitrix\Main\DB\Connection
    {
        return $this->getEntity()->getConnection();
    }
}
