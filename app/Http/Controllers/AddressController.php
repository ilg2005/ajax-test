<?php

namespace App\Http\Controllers;

use App\Models\Street;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cache;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $cacheKey = "addresses_search_" . md5($search . "_page_" . $request->input('page', 1));

        $addresses = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($search) {
            return Street::query()
                ->join('cities', 'streets.city_id', '=', 'cities.id')
                ->join('regions', 'cities.region_id', '=', 'regions.id')
                ->select([
                    'regions.name as region',
                    'cities.name as city',
                    'streets.name as street'
                ])
                ->when($search, function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('regions.name', 'like', "%{$search}%")
                            ->orWhere('cities.name', 'like', "%{$search}%")
                            ->orWhere('streets.name', 'like', "%{$search}%");
                    });
                })
                ->orderBy('streets.id')
                ->paginate(7);
        });

        return Inertia::render('Addresses', [
            'addresses' => $addresses,
            'filters' => ['search' => $search]
        ]);
    }
}
