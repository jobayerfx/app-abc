<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RestaurantTableSeeder extends Seeder
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

        Restaurant::create([
            [
                'user_id' => 2,
                'name' => 'XYZ Food Plaza',
                'lat' => 25.744860,
                'long' => 89.275589,
                'capture_time' => now(),
            ],
            [
                'user_id	' => 3,
                'name' => 'ABC Food Plaza',
                'lat' => 22.341900,
                'long' => 91.815536,
                'capture_time' => now(),
            ],
        ]);
    }
}
