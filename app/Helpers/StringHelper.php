<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * Remove todos os caracteres não numéricos de uma string
     *
     * @param string|null $value
     * @return string
     */
    public static function removeNonNumeric(?string $value): string
    {
        if (empty($value)) {
            return '';
        }

        return preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Remove todos os caracteres não numéricos de uma string e retorna como integer
     *
     * @param string|null $value
     * @return int
     */
    public static function toInteger(?string $value): int
    {
        $numericString = self::removeNonNumeric($value);

        return empty($numericString) ? 0 : (int) $numericString;
    }

    /**
     * Remove todos os caracteres não numéricos de uma string e retorna como float
     *
     * @param string|null $value
     * @return float
     */
    public static function toFloat(?string $value): float
    {
        if (empty($value)) {
            return 0.0;
        }

        // Remove tudo exceto números, ponto e vírgula
        $cleaned = preg_replace('/[^0-9.,]/', '', $value);

        // Substitui vírgula por ponto para padronizar
        $cleaned = str_replace(',', '.', $cleaned);

        // Remove pontos extras, mantendo apenas o primeiro
        $parts = explode('.', $cleaned);
        if (count($parts) > 2) {
            $cleaned = $parts[0] . '.' . implode('', array_slice($parts, 1));
        }

        return empty($cleaned) ? 0.0 : (float) $cleaned;
    }
}