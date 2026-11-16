<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/AsignaturaPersistenceDto.php';
require_once __DIR__ . '/../Entity/AsignaturaEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/AsignaturaModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/AsignaturaId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/AsignaturaNombre.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/AsignaturaCreditos.php';

final class AsignaturaPersistenceMapper
{
    public function fromModelToDto(AsignaturaModel $asignatura): AsignaturaPersistenceDto
    {
        return new AsignaturaPersistenceDto(
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

    public function fromRowToEntity(array $row): AsignaturaEntity
    {
        return new AsignaturaEntity(
            (string) $row['id'],
            (string) $row['nombre'],
            (string) $row['nombre_completo'],
            (string) $row['descripcion'],
            (string) $row['area_conocimiento'],
            (string) $row['carrera'],
            (int) $row['numero_creditos'],
            (string) $row['contenido_tematico'],
            (int) $row['semestre'],
            (string) $row['profesor'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(AsignaturaEntity $entity): AsignaturaModel
    {
        return new AsignaturaModel(
            new AsignaturaId($entity->id()),
            new AsignaturaNombre($entity->nombre()),
            $entity->nombreCompleto(),
            $entity->descripcion(),
            $entity->areaConocimiento(),
            $entity->carrera(),
            new AsignaturaCreditos($entity->creditos()),
            $entity->contenidoTematico(),
            $entity->semestre(),
            $entity->profesor()
        );
    }

    public function fromRowToModel(array $row): AsignaturaModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return AsignaturaModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
