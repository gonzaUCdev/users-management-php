<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateAsignaturaCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateAsignaturaCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteAsignaturaCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetAsignaturaByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/AsignaturaModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/AsignaturaId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/AsignaturaNombre.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/AsignaturaCreditos.php';

final class AsignaturaApplicationMapper
{
    public static function fromCreateCommandToModel(CreateAsignaturaCommand $command): AsignaturaModel
    {
        return new AsignaturaModel(
            new AsignaturaId($command->getId()),
            new AsignaturaNombre($command->getNombre()),
            $command->getNombreCompleto(),
            $command->getDescripcion(),
            $command->getAreaConocimiento(),
            $command->getCarrera(),
            new AsignaturaCreditos($command->getNumeroCreditos()),
            $command->getContenidoTematico(),
            $command->getSemestre(),
            $command->getProfesor()
        );
    }

    public static function fromUpdateCommandToModel(UpdateAsignaturaCommand $command): AsignaturaModel
    {
        return new AsignaturaModel(
            new AsignaturaId($command->getId()),
            new AsignaturaNombre($command->getNombre()),
            $command->getNombreCompleto(),
            $command->getDescripcion(),
            $command->getAreaConocimiento(),
            $command->getCarrera(),
            new AsignaturaCreditos($command->getNumeroCreditos()),
            $command->getContenidoTematico(),
            $command->getSemestre(),
            $command->getProfesor()
        );
    }

    public static function fromGetByIdQueryToId(GetAsignaturaByIdQuery $query): AsignaturaId
    {
        return new AsignaturaId($query->getId());
    }

    public static function fromDeleteCommandToId(DeleteAsignaturaCommand $command): AsignaturaId
    {
        return new AsignaturaId($command->getId());
    }
}
