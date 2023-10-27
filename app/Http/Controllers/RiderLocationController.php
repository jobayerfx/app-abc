<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RiderLocation;
use Illuminate\Http\Request;

class RiderLocationController extends Controller
{
    /*
    * Store time series data of rider location
    * */

    public function store(Request $request)
    {
        $data = $request->validate([
            'rider_id' => 'required|integer',
            'service_name' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'capture_time' => 'required|date',
        ]);

        $riderLocation = RiderLocation::create($data);

        return response()->json($riderLocation, 201);
    }
    /*
    * Find Nearby Riders information
    * */

    public function findNearbyRiders(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::query()->where('id', $restaurantId)->first();
        if ($restaurant) {
            return response(['error' => 1, 'message' => 'The Restaurant does n\'t exists.'], 404);
        }
        $lat = $restaurant->lat;
        $lng = $restaurant->long;
        $distance = 5; // For 5 Kilometers.

        $nearbyRiders = RiderLocation::selectRaw("
        *,
        (6371 * acos(cos(radians($lat)) * cos(radians(lat)) * cos(radians(lng) - radians($lng)) + sin(radians($lat)) * sin(radians(lat)))) AS distance
    ")
            ->where('service_name', 'food_delivery')
            ->having('distance', '<', $distance)
            ->orderBy('distance')
            ->get();

        return response()->json($nearbyRiders);
    }
}
