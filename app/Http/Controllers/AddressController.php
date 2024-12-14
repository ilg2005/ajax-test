<?php

namespace App\Http\Controllers;

use App\Models\Street;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Street::query()
            ->join('cities', 'streets.city_id', '=', 'cities.id')
            ->join('regions', 'cities.region_id', '=', 'regions.id')
            ->select([
                'regions.name as region',
                'cities.name as city',
                'streets.name as street'
            ])
            ->orderBy('streets.id')
            ->paginate(7);

        return Inertia::render('Addresses', [
            'addresses' => $addresses
        ]);
    }
}
