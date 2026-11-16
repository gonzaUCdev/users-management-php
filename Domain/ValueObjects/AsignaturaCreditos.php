<?php

require_once __DIR__ . '/../Exceptions/InvalidAsignaturaCreditosException.php';

class AsignaturaCreditos
{
    const MIN = 1;
    const MAX = 10;

    private $value;

    public function __construct($value)
    {
        $number = (int) $value;

        if ($number < self::MIN || $number > self::MAX) {
            throw InvalidAsignaturaCreditosException::becauseValueIsOutOfRange(self::MIN, self::MAX, $number);
        }

        $this->value = $number;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(AsignaturaCreditos $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
