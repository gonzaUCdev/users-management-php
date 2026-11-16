<?php

require_once __DIR__ . '/../ValueObjects/AsignaturaId.php';
require_once __DIR__ . '/../ValueObjects/AsignaturaNombre.php';
require_once __DIR__ . '/../ValueObjects/AsignaturaCreditos.php';

final class AsignaturaModel
{
    private AsignaturaId $id;
    private AsignaturaNombre $nombre;
    private string $nombreCompleto;
    private string $descripcion;
    private string $areaConocimiento;
    private string $carrera;
    private AsignaturaCreditos $creditos;
    private string $contenidoTematico;
    private int $semestre;
    private string $profesor;

    public function __construct(
        AsignaturaId $id,
        AsignaturaNombre $nombre,
        string $nombreCompleto,
        string $descripcion,
        string $areaConocimiento,
        string $carrera,
        AsignaturaCreditos $creditos,
        string $contenidoTematico,
        int $semestre,
        string $profesor
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nombreCompleto = trim($nombreCompleto);
        $this->descripcion = trim($descripcion);
        $this->areaConocimiento = trim($areaConocimiento);
        $this->carrera = trim($carrera);
        $this->creditos = $creditos;
        $this->contenidoTematico = trim($contenidoTematico);
        $this->semestre = $semestre;
        $this->profesor = trim($profesor);
    }

    public function id(): AsignaturaId
    {
        return $this->id;
    }

    public function nombre(): AsignaturaNombre
    {
        return $this->nombre;
    }

    public function nombreCompleto(): string
    {
        return $this->nombreCompleto;
    }

    public function descripcion(): string
    {
        return $this->descripcion;
    }

    public function areaConocimiento(): string
    {
        return $this->areaConocimiento;
    }

    public function carrera(): string
    {
        return $this->carrera;
    }

    public function creditos(): AsignaturaCreditos
    {
        return $this->creditos;
    }

    public function contenidoTematico(): string
    {
        return $this->contenidoTematico;
    }

    public function semestre(): int
    {
        return $this->semestre;
    }

    public function profesor(): string
    {
        return $this->profesor;
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'nombre' => $this->nombre->value(),
            'nombreCompleto' => $this->nombreCompleto,
            'descripcion' => $this->descripcion,
            'areaConocimiento' => $this->areaConocimiento,
            'carrera' => $this->carrera,
            'creditos' => $this->creditos->value(),
            'contenidoTematico' => $this->contenidoTematico,
            'semestre' => $this->semestre,
            'profesor' => $this->profesor,
        );
    }
}
