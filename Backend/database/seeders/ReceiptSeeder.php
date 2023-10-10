<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receipt::create([
            'enrollment_id' => 1,
            'payment_timestamp' => '2022-12-07 09:10:00',
            'receipt_timestamp' => '2022-12-08 09:00:00',
            'description' => 'Course fee',
            'amount' => 7500.00,
            'subtotal' => 7500.00,
            'total' => 7500.00,
            'created_at' => '2022-12-08 09:00:00',
            'updated_at' => '2022-12-08 09:00:00'
        ]);

        Receipt::create([
            'enrollment_id' => 2,
            'payment_timestamp' => '2022-12-07 10:05:00',
            'receipt_timestamp' => '2022-12-08 09:02:00',
            'description' => 'Course fee',
            'amount' => 7500.00,
            'subtotal' => 7500.00,
            'total' => 7500.00,
            'created_at' => '2022-12-08 09:02:00',
            'updated_at' => '2022-12-08 09:02:00'
        ]);
    }
}
