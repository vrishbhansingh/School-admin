<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserPlanExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        // Convert IncomeHistory to string for Excel
        return array_map(function ($row) {
            $row['Income History'] = implode(" | ", $row['Income History']);
            return [
                $row['Username'],
                $row['Parent'] ?? '-',
                $row['Left'] ?? '-',
                $row['Right'] ?? '-',
                $row['Current Level'],
                $row['Total Income'],
                $row['Income History']
            ];
        }, $this->data);
    }

    public function headings(): array
    {
        return [
            'Username',
            'Parent',
            'Left Child',
            'Right Child',
            'Current Level',
            'Total Income (₹)',
            'Income History'
        ];
    }
}
