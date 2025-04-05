<?php

declare(strict_types=1);

/**
 * @global  CMain $APPLICATION
 */


use Otus\Local\Infrastructure\Repository\Doctor\DoctorRepository;

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$doctorRepository = new DoctorRepository();

foreach ($doctorRepository->getDoctorList() as $doctor) {
    echo $doctor->getName() . '<br>';
    foreach ($doctor->getProcedure()->getAll() as $procedure) {
        echo $procedure->getElement()->getName() . '<br>';
    }
}

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
