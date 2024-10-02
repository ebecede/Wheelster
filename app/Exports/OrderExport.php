<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OrderExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $month;
    protected $totalProfit = 0;

    public function __construct($month)
    {
        $this->month = $month;
    }

    // Fetch the orders collection filtered by the selected month and status 'Complete'
    public function collection()
    {
        $query = Order::with('user', 'product')->where('status', 'Complete'); // Filter by status

        if ($this->month) {
            $query->whereYear('scheduleDate', '=', date('Y', strtotime($this->month)))
                  ->whereMonth('scheduleDate', '=', date('m', strtotime($this->month)));
        }

        return $query->get();
    }

    // Map the data for each row in the Excel file
    public function map($order): array
    {
        // Calculate total profit for the current order
        $profit = $order->product->price;
        $this->totalProfit += $profit; // Add to total profit

        return [
            $order->user->name,            // Customer Name
            $order->product->name,         // Product Name
            // $order->product->price,        // Product Price
            $order->scheduleDate,          // Schedule Date
            $profit                         // Total Profit (price * quantity)
        ];
    }

    // Define the headings for the Excel sheet
    public function headings(): array
    {
        return [
            'Customer Name',
            'Product Name',

            'Schedule Date',
            'Price',
            // 'Total Profit',
        ];
    }

    // Handle the total profit calculation and display it in the footer
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Set the heading row to bold and add borders
                $event->sheet->getStyle('A1:D1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'], // Black border
                        ],
                    ],
                ]);

                // Add borders for all data rows
                $rowCount = count($this->collection()) + 1; // +2 for the header and total row
                $event->sheet->getStyle('A1:D' . $rowCount)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'], // Black border
                        ],
                    ],
                ]);

                // Write the total profit at the bottom of the sheet
                $totalRow = [
                    ['Total Profit', '', '', $this->totalProfit]  // Display total profit
                ];
                $event->sheet->appendRows($totalRow, $event);
            },
        ];
    }
    
}
