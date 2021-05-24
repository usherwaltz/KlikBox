<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class OrderExport implements FromQuery, WithColumnWidths, WithMapping, WithHeadings, WithStyles
{
    use Exportable;

    public $toMerge = [];
    public $lastID = '';

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
            'orders.updated_at as date',
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
            'E' => 20,
            'F' => 35,
            'G' => 15,
            'H' => 40,
            'I' => 15,
            'J' => 15

        ];
    }

    public function map($row): array
    {
        if($this->lastID == '') {
            $this->lastID = $row->id;
            $this->toMerge[] = count($row->items);
        } elseif($this->lastID != $row->id) {
            $this->lastID = $row->id;
            $this->toMerge[] = count($row->items);
        }

        return [
            $row->id,
            date('d.m.Y H:i:s', strtotime($row->date)),
            $row->firstname,
            $row->lastname,
            $row->city,
            $row->street,
            $row->postcode,
            $row->name,
            $row->amount,
            $row->price . " KM",
        ];
    }

    public function headings(): array
    {
        return [
            'JEDINSTVENI BROJ NARUDŽBE',
            "DATUM",
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
        $sheet->getStyle("A1:J1")->getFont()->setBold(true);
        $sheet->getStyle('A:J')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('A:J')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        $currentRow = 2;

        foreach ($this->toMerge as $mergeCount) {
            $final = $currentRow + $mergeCount - 1;
            $sheet->mergeCells("A$currentRow:A$final");
            $sheet->mergeCells("B$currentRow:B$final");
            $sheet->mergeCells("C$currentRow:C$final");
            $sheet->mergeCells("D$currentRow:D$final");
            $sheet->mergeCells("E$currentRow:E$final");
            $sheet->mergeCells("F$currentRow:F$final");
            $sheet->mergeCells("G$currentRow:G$final");
            $currentRow = $final + 1;
        }
    }
}
