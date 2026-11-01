<?php

namespace App\Http\Controllers;

//Dit vertelt PHP waar een class te vinden is.
use App\Models\Cafe;
use App\Models\Category;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    //Laat een lijst zien van alles
    public function index(Request $request) {

        //Start de query
        $query = Cafe::with('category') //with voor alle categorieen in 1 extra query (eager loading)
            ->withCount('reviews');

        if($request->filled('search')) { //Gebruiker iets getypt in het zoekveld? Zo nee? Skip.
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('city', 'like', '%' . $request->search . '%'); //meerdere columns
            });
        }

        //user hoeft niet elk filter te gebruiken, daarom meerdere if statements
        if ($request->filled('city')) {
            $query->where('city', $request->city);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }


        //sorteert van a-z, 12 cafes per page (snellere website), behoud filters in volgende pages
        $cafes = $query->orderBy('name')->paginate(12)->withQueryString();

        //dropdown opties, alle categories van de database, elke stad die een cafe heeft
        $categories = Category::orderBy('name')->get();
        $cities = Cafe::select('city')->distinct()->orderBy('city')->pluck('city');

        //stuurt alles naar de view
        return view('cafes.index', compact('cafes', 'categories', 'cities'));
    }

    public function create(){
        //pakt alle categorien van de database, voor de dropdown in form
        $categories = Category::orderBy('name')->get();

        //
        return view('cafes.create', compact('categories'));
    }

    public function store(Request $request){
        //checkt de input, als het verkeerd is stuurt laravel de gebruiker automatisch terug naar de form, met een error message
        $data = $request->validate([
            'name' => 'required|max:255',
            'city' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Cafe::create($data);

        return redirect(route('cafes.index'));

    }

    public function show(Cafe $cafe){
        //laadt de categorie en de reviews met wie het heeft geschreven
        $cafe->load('category', 'reviews.user');

        return view('cafes.show', compact('cafe'));
    }

    //verwijdert een cafe
    public function destroy(Cafe $cafe)
    {
        $cafe->delete();

        return redirect()->route('cafes.index');
    }

}
