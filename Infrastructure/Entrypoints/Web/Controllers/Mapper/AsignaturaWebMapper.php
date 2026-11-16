<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateAsignaturaRequest.php';
require_once __DIR__ . '/../Dto/UpdateAsignaturaRequest.php';
require_once __DIR__ . '/../Dto/AsignaturaResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateAsignaturaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateAsignaturaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteAsignaturaCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetAsignaturaByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/AsignaturaModel.php';

final class AsignaturaWebMapper
{
    public function fromCreateRequestToCommand(CreateAsignaturaWebRequest $request): CreateAsignaturaCommand
    {
        return new CreateAsignaturaCommand(
            $request->getId(),
            $request->getNombre(),
            $request->getNombreCompleto(),
            $request->getDescripcion(),
            $request->getAreaConocimiento(),
            $request->getCarrera(),
            $request->getNumeroCreditos(),
            $request->getContenidoTematico(),
            $request->getSemestre(),
            $request->getProfesor()
        );
    }

    public function fromUpdateRequestToCommand(UpdateAsignaturaWebRequest $request): UpdateAsignaturaCommand
    {
        return new UpdateAsignaturaCommand(
            $request->getId(),
            $request->getNombre(),
            $request->getNombreCompleto(),
            $request->getDescripcion(),
            $request->getAreaConocimiento(),
            $request->getCarrera(),
            $request->getNumeroCreditos(),
            $request->getContenidoTematico(),
            $request->getSemestre(),
            $request->getProfesor()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetAsignaturaByIdQuery
    {
        return new GetAsignaturaByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteAsignaturaCommand
    {
        return new DeleteAsignaturaCommand($id);
    }

    public function fromModelToResponse(AsignaturaModel $asignatura): AsignaturaResponse
    {
        return new AsignaturaResponse(
            $asignatura->id()->value(),
            $asignatura->nombre()->value(),
            $asignatura->nombreCompleto(),
            $asignatura->descripcion(),
            $asignatura->areaConocimiento(),
            $asignatura->carrera(),
            $asignatura->creditos()->value(),
            $asignatura->contenidoTematico(),
            $asignatura->semestre(),
            $asignatura->profesor()
        );
    }

    /**
     * @param AsignaturaModel[] $asignaturas
     * @return AsignaturaResponse[]
     */
    public function fromModelsToResponses(array $asignaturas): array
    {
        $responses = array();

        foreach ($asignaturas as $asignatura) {
            $responses[] = $this->fromModelToResponse($asignatura);
        }

        return $responses;
    }
}
