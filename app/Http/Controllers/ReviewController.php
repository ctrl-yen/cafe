<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //Slaat een nieuwe review op voor een cafe
    public function store(Request $request, Cafe $cafe){
        $user = $request->user();

        //Diepere validatie: hoeveel dagen de gebruiker heeft ingelogd (Eloquent query)
        $loginDays = $user->logins()
            ->distinct()
            ->count(DB::raw('DATE(created_at)'));

        //Minder dan 3 dagen? terug naar de form met error
        if($loginDays < 3) {
            return back()->withErrors([
                'body' => 'Niet vaak genoeg ingelogd. ' . $loginDays . '/3 keer',
            ]);
        }

        //Normale validatie van review
        $data = $request->validate([
            'body' => 'required|min:10|max:1000'
        ]);

        //Review opslaan
        $user->reviews()->create([
            'cafe_id' => $cafe->id,
            'body' => $data['body'],
        ]);

        //Terug naar de cafe page
        return redirect()->route('cafes.show', $cafe);
    }

    public function destroy(Review $review){
        $review->delete();

        //terug naar de page (cafes)
        return back();

    }

    //laat de form zien om te kunnen editen
    public function edit(Review $review){
        return view('reviews.edit', compact('review'));
    }

    //Slaat de aangepaste review op
    public function update(Request $request, Review $review){
        $data = $request->validate([
            'body' => 'required|min:10|max:1000',
        ]);

        $review->update($data);

        return redirect()->route('cafes.show', $review->cafe_id);
    }

}
