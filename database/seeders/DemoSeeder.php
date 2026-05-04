<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Estimation;
use App\Models\EstimationItem;
use App\Models\Invoice;
use App\Models\InvoiceItem;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // ========================
        // CUSTOMER (10 DATA)
        // ========================
        $customers = [];

        for ($i = 1; $i <= 10; $i++) {
            $customers[] = Customer::create([
                'name' => 'Customer ' . $i,
                'email' => "customer$i@mail.com",
                'phone' => '08' . rand(111111111, 999999999),
                'address' => 'Kota ' . $i
            ]);
        }

        // ========================
        // ITEMS (15 DATA)
        // ========================
        $items = [];

        for ($i = 1; $i <= 15; $i++) {
            $items[] = Item::create([
                'name' => 'Sparepart ' . $i,
                'stock' => rand(10, 100),
                'buy_price' => rand(20000, 100000),
                'sell_price' => rand(50000, 200000),
            ]);
        }

        // ========================
        // ESTIMATIONS + INVOICES
        // ========================
        for ($e = 1; $e <= 15; $e++) {

            $customer = $customers[array_rand($customers)];

            // ===== ESTIMATION =====
            $estimation = Estimation::create([
                'customer_id' => $customer->id,
                'date' => now()->subDays(rand(1, 10)),
                'status' => 'approved',
                'total' => 0
            ]);

            $totalEst = 0;

            $randomItems = collect($items)->random(rand(2, 4));

            foreach ($randomItems as $item) {

                $qty = rand(1, 3);
                $subtotal = $qty * $item->sell_price;

                EstimationItem::create([
                    'estimation_id' => $estimation->id,
                    'type' => 'item',
                    'item_id' => $item->id,
                    'qty' => $qty,
                    'price' => $item->sell_price,
                    'subtotal' => $subtotal
                ]);

                $totalEst += $subtotal;
            }

            $estimation->update(['total' => $totalEst]);

            // ===== INVOICE (80% dari estimasi)
            if (rand(1, 100) <= 80) {

                $invoice = Invoice::create([
                    'customer_id' => $customer->id,
                    'estimation_id' => $estimation->id,
                    'invoice_no' => 'INV-' . now()->format('Ymd') . '-' . str_pad($e, 4, '0', STR_PAD_LEFT),
                    'date' => now(),
                    'total' => 0,
                    'status' => rand(0, 1) ? 'unpaid' : 'paid'
                ]);

                $totalInv = 0;

                foreach ($randomItems as $item) {

                    $qty = rand(1, 3);
                    $subtotal = $qty * $item->sell_price;

                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'type' => 'item',
                        'item_id' => $item->id,
                        'name' => $item->name,
                        'qty' => $qty,
                        'price' => $item->sell_price,
                        'subtotal' => $subtotal
                    ]);

                    $totalInv += $subtotal;
                }

                $invoice->update(['total' => $totalInv]);
            }
        }
    }
}