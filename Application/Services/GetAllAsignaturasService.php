<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllAsignaturasUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllAsignaturasPort.php';

final class GetAllAsignaturasService implements GetAllAsignaturasUseCase
{
    private GetAllAsignaturasPort $getAllAsignaturasPort;

    public function __construct(GetAllAsignaturasPort $getAllAsignaturasPort)
    {
        $this->getAllAsignaturasPort = $getAllAsignaturasPort;
    }

    /**
     * @return AsignaturaModel[]
     */
    public function execute(GetAllAsignaturasQuery $query): array
    {
        return $this->getAllAsignaturasPort->getAll();
    }
}
