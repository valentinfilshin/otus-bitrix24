<?php

namespace Otus\Local\Infrastructure\Repository\Doctor;

use Bitrix\Main\ORM\Objectify\Collection;
use Otus\Local\Infrastructure\Repository\AbstractIblockRepository;

class DoctorRepository extends AbstractIblockRepository
{
    public function __construct()
    {
        parent::__construct('doctor');
    }

    public function getDoctorList(): Collection
    {
        $queryBuilder = $this->getQuery();
        $queryBuilder->setSelect(
            [
                'ID',
                'NAME',
                'CODE',
                'PROCEDURE' => 'PROCEDURE.ELEMENT'
            ]
        );

        return $queryBuilder->exec()->fetchCollection();
    }
}
