<?php

namespace Database\Seeders;

use App\Models\RiderLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RiderLocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('rider_locations')->truncate();
        Schema::enableForeignKeyConstraints();

        RiderLocation::create([
            'rider_id' => 1,
            'service_name' => 'food_delivery',
            'lat' => 40.7128,
            'lng' => -74.0060,
            'capture_time' => now(),
        ]);

    }
}
