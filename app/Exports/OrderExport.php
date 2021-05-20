<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class OrderExport implements FromQuery, WithColumnWidths, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    public function query()
    {
        return Order::query()->select([
            'orders.id',
            'orders.name as firstname',
            'lastname',
            'city',
            'street',
            'postcode',
            'email',
            'phone',
            'items.name',
            'items.qty as amount',
            'items.price as price',
        ])->rightJoin('items', 'items.order_id', '=', 'orders.id');
    }

    public function columnWidths(): array
    {
        return [
            'A' => 40,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 35,
            'F' => 15,
            'G' => 40,
            'H' => 15,
            'I' => 15

        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->firstname,
            $row->lastname,
            $row->city,
            $row->street,
            $row->postcode,
            $row->name,
            $row->amount,
            $row->price . " KM"
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'IME',
            'PREZIME',
            'GRAD',
            "ADRESA",
            "ZIP KOD",
            "PROIZVOD",
            "KOLIČINA",
            "CIJENA"
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle("A1:I1")->getFont()->setBold(true);
    }
}
