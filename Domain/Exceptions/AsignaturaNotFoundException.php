<?php

class AsignaturaNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id)
    {
        return new self('The asignatura with id ' . $id . ' was not found.');
    }
}
