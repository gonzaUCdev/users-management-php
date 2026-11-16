<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateAsignaturaUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveAsignaturaPort.php';
require_once __DIR__ . '/Mappers/AsignaturaApplicationMapper.php';

final class CreateAsignaturaService implements CreateAsignaturaUseCase
{
    private SaveAsignaturaPort $saveAsignaturaPort;

    public function __construct(SaveAsignaturaPort $saveAsignaturaPort)
    {
        $this->saveAsignaturaPort = $saveAsignaturaPort;
    }

    public function execute(CreateAsignaturaCommand $command): AsignaturaModel
    {
        $asignatura = AsignaturaApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveAsignaturaPort->save($asignatura);
    }
}
