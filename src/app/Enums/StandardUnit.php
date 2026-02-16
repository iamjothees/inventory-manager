<?php

namespace App\Enums;

enum StandardUnit: string
{
    // Count
    case Piece = 'piece';
    case Dozen = 'dozen';
    case Pair = 'pair';

    // Weight
    case Kilogram = 'kilogram';
    case Gram = 'gram';
    case Milligram = 'milligram';
    case Tonne = 'tonne';
    case Pound = 'pound';
    case Ounce = 'ounce';

    // Volume
    case Litre = 'litre';
    case Millilitre = 'millilitre';
    case Gallon = 'gallon';

    // Length
    case Metre = 'metre';
    case Centimetre = 'centimetre';
    case Millimetre = 'millimetre';
    case Inch = 'inch';
    case Foot = 'foot';

    // Area
    case SquareMetre = 'square_metre';
    case SquareFoot = 'square_foot';

    /**
     * Get the display details for this unit.
     *
     * @return array{name: string, code: string, decimalPrecision: int}
     */
    public function details(): array
    {
        return match ($this) {
                // Count
            self::Piece => ['name' => 'Piece', 'code' => 'pcs', 'decimalPrecision' => 0],
            self::Dozen => ['name' => 'Dozen', 'code' => 'doz', 'decimalPrecision' => 0],
            self::Pair => ['name' => 'Pair', 'code' => 'pr', 'decimalPrecision' => 0],

                // Weight
            self::Kilogram => ['name' => 'Kilogram', 'code' => 'kg', 'decimalPrecision' => 3],
            self::Gram => ['name' => 'Gram', 'code' => 'g', 'decimalPrecision' => 2],
            self::Milligram => ['name' => 'Milligram', 'code' => 'mg', 'decimalPrecision' => 0],
            self::Tonne => ['name' => 'Tonne', 'code' => 't', 'decimalPrecision' => 3],
            self::Pound => ['name' => 'Pound', 'code' => 'lb', 'decimalPrecision' => 2],
            self::Ounce => ['name' => 'Ounce', 'code' => 'oz', 'decimalPrecision' => 2],

                // Volume
            self::Litre => ['name' => 'Litre', 'code' => 'L', 'decimalPrecision' => 3],
            self::Millilitre => ['name' => 'Millilitre', 'code' => 'mL', 'decimalPrecision' => 0],
            self::Gallon => ['name' => 'Gallon', 'code' => 'gal', 'decimalPrecision' => 2],

                // Length
            self::Metre => ['name' => 'Metre', 'code' => 'm', 'decimalPrecision' => 3],
            self::Centimetre => ['name' => 'Centimetre', 'code' => 'cm', 'decimalPrecision' => 2],
            self::Millimetre => ['name' => 'Millimetre', 'code' => 'mm', 'decimalPrecision' => 1],
            self::Inch => ['name' => 'Inch', 'code' => 'in', 'decimalPrecision' => 2],
            self::Foot => ['name' => 'Foot', 'code' => 'ft', 'decimalPrecision' => 2],

                // Area
            self::SquareMetre => ['name' => 'Square Metre', 'code' => 'sqm', 'decimalPrecision' => 2],
            self::SquareFoot => ['name' => 'Square Foot', 'code' => 'sqft', 'decimalPrecision' => 2],
        };
    }

    /**
     * Get all standard units as options for a dropdown.
     *
     * @return array<int, array{value: string, label: string, name: string, code: string, decimalPrecision: int}>
     */
    public static function options(): array
    {
        return array_map(function (self $case) {
            $details = $case->details();

            return [
                'value' => $case->value,
                'label' => "{$details['name']} ({$details['code']})",
                ...$details,
            ];
        }, self::cases());
    }

    public function label(): string
    {
        $details = $this->details();

        return "{$details['name']} ({$details['code']})";
    }
}
