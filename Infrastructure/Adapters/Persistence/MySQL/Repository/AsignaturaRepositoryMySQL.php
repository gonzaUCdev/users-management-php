<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveAsignaturaPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateAsignaturaPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAsignaturaByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllAsignaturasPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteAsignaturaPort.php';

require_once __DIR__ . '/../Mapper/AsignaturaPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/AsignaturaModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/AsignaturaId.php';

final class AsignaturaRepositoryMySQL implements
    SaveAsignaturaPort,
    UpdateAsignaturaPort,
    GetAsignaturaByIdPort,
    GetAllAsignaturasPort,
    DeleteAsignaturaPort
{
    private PDO $pdo;
    private AsignaturaPersistenceMapper $mapper;

    public function __construct(PDO $pdo, AsignaturaPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(AsignaturaModel $asignatura): AsignaturaModel
    {
        $dto = $this->mapper->fromModelToDto($asignatura);

        $sql = '
            INSERT INTO asignaturas (
                id,
                nombre,
                nombre_completo,
                descripcion,
                area_conocimiento,
                carrera,
                numero_creditos,
                contenido_tematico,
                semestre,
                profesor,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :nombre,
                :nombre_completo,
                :descripcion,
                :area_conocimiento,
                :carrera,
                :numero_creditos,
                :contenido_tematico,
                :semestre,
                :profesor,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->paramsFromDto($dto));

        $saved = $this->getById(new AsignaturaId($dto->id()));

        if ($saved === null) {
            throw new RuntimeException('The asignatura could not be recovered after save.');
        }

        return $saved;
    }

    public function update(AsignaturaModel $asignatura): AsignaturaModel
    {
        $dto = $this->mapper->fromModelToDto($asignatura);

        $sql = '
            UPDATE asignaturas
               SET nombre = :nombre,
                   nombre_completo = :nombre_completo,
                   descripcion = :descripcion,
                   area_conocimiento = :area_conocimiento,
                   carrera = :carrera,
                   numero_creditos = :numero_creditos,
                   contenido_tematico = :contenido_tematico,
                   semestre = :semestre,
                   profesor = :profesor,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->paramsFromDto($dto));

        $updated = $this->getById(new AsignaturaId($dto->id()));

        if ($updated === null) {
            throw new RuntimeException('The asignatura could not be recovered after update.');
        }

        return $updated;
    }

    public function getById(AsignaturaId $asignaturaId): ?AsignaturaModel
    {
        $sql = '
            SELECT
                id,
                nombre,
                nombre_completo,
                descripcion,
                area_conocimiento,
                carrera,
                numero_creditos,
                contenido_tematico,
                semestre,
                profesor,
                created_at,
                updated_at
            FROM asignaturas
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $asignaturaId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return AsignaturaModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                nombre,
                nombre_completo,
                descripcion,
                area_conocimiento,
                carrera,
                numero_creditos,
                contenido_tematico,
                semestre,
                profesor,
                created_at,
                updated_at
            FROM asignaturas
            ORDER BY nombre ASC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(AsignaturaId $asignaturaId): void
    {
        $sql = 'DELETE FROM asignaturas WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $asignaturaId->value(),
        ));
    }

    /**
     * @return array<string, mixed>
     */
    private function paramsFromDto(AsignaturaPersistenceDto $dto): array
    {
        return array(
            ':id' => $dto->id(),
            ':nombre' => $dto->nombre(),
            ':nombre_completo' => $dto->nombreCompleto(),
            ':descripcion' => $dto->descripcion(),
            ':area_conocimiento' => $dto->areaConocimiento(),
            ':carrera' => $dto->carrera(),
            ':numero_creditos' => $dto->creditos(),
            ':contenido_tematico' => $dto->contenidoTematico(),
            ':semestre' => $dto->semestre(),
            ':profesor' => $dto->profesor(),
        );
    }
}
