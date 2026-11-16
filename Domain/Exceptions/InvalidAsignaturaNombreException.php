<?php

class InvalidAsignaturaNombreException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The asignatura nombre must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The asignatura nombre must contain at least ' . $minLength . ' characters.');
    }
}
