<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Burger;
use App\Models\Taco;
use App\Models\Sandwich;
use App\Models\Salade;
use App\Models\Dessert;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // Validation du paramètre de filtre (?cat=...)
        $validated = $request->validate([
            'cat' => 'nullable|in:burgers,tacos,sandwiches,salades,desserts',
        ]);

        $cat = $validated['cat'] ?? null;

        // Charge uniquement ce qui est nécessaire selon le filtre
        $burgers    = $cat && $cat !== 'burgers'    ? collect() : Burger::orderBy('nom')->get();
        $tacos      = $cat && $cat !== 'tacos'      ? collect() : Taco::orderBy('nom')->get();
        $sandwiches = $cat && $cat !== 'sandwiches' ? collect() : Sandwich::orderBy('nom')->get();
        $salades    = $cat && $cat !== 'salades'    ? collect() : Salade::orderBy('nom')->get();
        $desserts   = $cat && $cat !== 'desserts'   ? collect() : Dessert::orderBy('nom')->get();

        return view('menu.index', compact(
            'burgers', 'tacos', 'sandwiches', 'salades', 'desserts', 'cat'
        ));
    }
}
