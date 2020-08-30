<?php

namespace Yiisoft\Strings;

/**
 * Provides static methods to work with numeric strings.
 */
final class NumericHelper
{
    /**
     * Converts number to its ordinal English form. For example, converts 13 to 13th, 2 to 2nd etc.
     * @param int|float|string $value The number to get its ordinal value.
     * @return string
     */
    public static function toOrdinal($value): ?string
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Value must be numeric.');
        }

        if (fmod($value, 1) !== 0.00) {
            return $value;
        }

        if (\in_array($value % 100, range(11, 13), false)) {
            return $value . 'th';
        }
        switch ($value % 10) {
            case 1:
                return $value . 'st';
            case 2:
                return $value . 'nd';
            case 3:
                return $value . 'rd';
            default:
                return $value . 'th';
        }
    }

    /**
     * Returns string representation of a number value without thousands separators and with dot as decimal separator.
     * @param int|float|string $value
     * @return string
     */
    public static function normalize($value): string
    {
        if (!is_scalar($value)) {
            throw new \InvalidArgumentException('Value must be scalar.');
        }

        $value = (string)$value;
        $value = str_replace([" ", ","], ["", "."], $value);
        return preg_replace('/\.(?=.*\.)/', '', $value);
    }
}
