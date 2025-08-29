<?php

namespace App\Http\Controllers;

// J’importe les classes dont j’ai besoin :
// - Request : pour récupérer les données envoyées dans l’URL (ex: ?cat=...)
// - Mes modèles : Burger, Taco, Sandwich, Salade, Dessert
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
        // ===============================
        // 1) Validation du paramètre ?cat
        // ===============================
        // Je valide le paramètre "cat" passé dans l’URL.
        // Il est optionnel (nullable) mais si présent,
        // il doit absolument faire partie de cette liste :
        // burgers, tacos, sandwiches, salades, desserts.
        // Exemple valide : /menu?cat=burgers
        $validated = $request->validate([
            'cat' => 'nullable|in:burgers,tacos,sandwiches,salades,desserts',
        ]);

        // Je récupère la catégorie demandée (ou null si aucune)
        $cat = $validated['cat'] ?? null;

        // ===============================
        // 2) Chargement conditionnel des données
        // ===============================
        // Pour optimiser, je ne charge en base que ce qui est nécessaire.
        // - Si "cat" est précisé, je ne charge que cette catégorie.
        // - Sinon, je charge toutes les catégories.
        //
        // Astuce : j’utilise `collect()` pour renvoyer une collection vide
        // si la catégorie n’est pas demandée → cela évite d’avoir des erreurs
        // dans la vue quand je boucle dessus.
        $burgers    = $cat && $cat !== 'burgers'    ? collect() : Burger::orderBy('nom')->get();
        $tacos      = $cat && $cat !== 'tacos'      ? collect() : Taco::orderBy('nom')->get();
        $sandwiches = $cat && $cat !== 'sandwiches' ? collect() : Sandwich::orderBy('nom')->get();
        $salades    = $cat && $cat !== 'salades'    ? collect() : Salade::orderBy('nom')->get();
        $desserts   = $cat && $cat !== 'desserts'   ? collect() : Dessert::orderBy('nom')->get();

        // ===============================
        // 3) Retour de la vue
        // ===============================
        // J’envoie à ma vue Blade "menu.index" toutes les collections
        // (burgers, tacos, sandwiches, salades, desserts) ainsi que $cat
        // pour savoir si un filtre est appliqué ou non.
        return view('menu.index', compact(
            'burgers', 'tacos', 'sandwiches', 'salades', 'desserts', 'cat'
        ));
    }
}
