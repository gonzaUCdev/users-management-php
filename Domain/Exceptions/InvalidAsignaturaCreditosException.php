<?php

class InvalidAsignaturaCreditosException extends InvalidArgumentException
{
    public static function becauseValueIsOutOfRange($min, $max, $value)
    {
        return new self(
            'The asignatura creditos must be between ' . $min . ' and ' . $max . ', got ' . $value . '.'
        );
    }
}
