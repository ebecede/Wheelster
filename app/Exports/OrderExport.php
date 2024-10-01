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

    // Fetch the orders collection filtered by the selected month
    public function collection()
    {
        $query = Order::with('user', 'product');

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
            $order->product->price,        // Product Price
            $order->scheduleDate,          // Schedule Date
            $profit                        // Total Profit (price * quantity)
        ];
    }

    // Define the headings for the Excel sheet
    public function headings(): array
    {
        return [
            'Customer Name',
            'Product Name',
            'Price',
            'Schedule Date',
            'Total Profit',
        ];
    }

    // Handle the total profit calculation and display it in the footer
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Write the total profit at the bottom of the sheet
                $totalRow = [
                    ['Total Profit', '', '', '', $this->totalProfit]  // Display total profit
                ];
                $event->sheet->appendRows($totalRow, $event);
            },
        ];
    }
}
