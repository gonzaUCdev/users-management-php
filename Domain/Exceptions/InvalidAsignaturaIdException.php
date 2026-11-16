<?php

class InvalidAsignaturaIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The asignatura id must not be empty.');
    }
}
