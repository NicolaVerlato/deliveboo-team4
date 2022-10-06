<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;
use App\Type;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prendo dati utente loggato
        $user = Auth::user();
        // prendo il ristorante che corrisponde all'utente loggato
        $restaurants = Restaurant::where('user_id', '=', $user->id)->get();
        $now = Carbon::now();
        // variabile per controllare se l'account ha già un ristorante
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        $data = [
            'restaurants' => $restaurants,
            'now' => $now,
            // la passo alla dashboard
            'restaurantLink' => $restaurantLink
        ];

        return view('admin.restaurants.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // prendo dati utente loggato
        $user = Auth::user();
        // variabile per controllare se l'account ha già un ristorante
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();
        // dd($restaurantLink);
        // dd(!empty($restaurantLink));
        if (count($restaurantLink) == 0 ) {
            // prendo tutti i possibili tipi di ristorante e li passo alla view
            $types = Type::all();
            return view('admin.restaurants.create', compact('types'));
        } else {
            return view('admin.restaurants.errors.create_error', compact('restaurantLink'));
        } 
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valido i dati del form
        $request->validate($this->getValidatedRestaurant());

        // passo dati form in form_data
        $form_data = $request->all();

        // se in form data c'è una immagine
        if(isset($form_data['cover'])) {
            // salvo l'immagine
            $img_path = Storage::put('restaurants-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }

        // prendo dati utente loggato
        $user = Auth::user();

        $new_restaurant = new Restaurant;
        $new_restaurant->fill($form_data);

        // genero slug per il ristorante
        $new_restaurant->slug = $this->getSlugFromTitle($new_restaurant->name);
        // setto la FK tramite l'id dell'utente loggato
        $new_restaurant->user_id = $user->id;

        $new_restaurant->save();

        // se in form_data abbiamo types
        if(isset($form_data['types'])) {
            // sincronizzo la categoria del ristorante
            $new_restaurant->types()->sync($form_data['types']);
        }
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $now = Carbon::now();
        $user = Auth::user();
        // variabile per controllare se l'account ha già un ristorante
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        $data = [
            'restaurant' => $restaurant,
            'now' => $now,
            'restaurantLink' => $restaurantLink
        ];

        // se l'id del ristorante richiesto è lo stesso dell'user
        if ($restaurant->user_id === $user->id) {
            // torno la show del ristorante richiesto
            return view('admin.restaurants.show', $data);
        } else {
            // altrimenti torno pagina di errore
            return view('admin.dishes.errors.error', $data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // la delete è gia pronta basta togliere il commento --------
        // $restaurant_to_delete = Restaurant::findOrFail($id);

        // if($restaurant_to_delete->cover) {
        //     Storage::delete($restaurant_to_delete->cover);
        // }

        // $restaurant_to_delete->types()->sync([]);

        // $restaurant_to_delete->delete();

        // return redirect()->route('admin.restaurants.index');

        // -----------------------------------------------------------
    }

    // funzione per ottenere lo slug
    protected function getSlugFromTitle($title) {
        $slug_to_save = Str::slug($title, '-');
        $slug_base = $slug_to_save;
        $existing_slug = Restaurant::where('slug', '=', $slug_to_save)->first();

        $counter = 1;
        while($existing_slug) {
            $slug_to_save = $slug_base . '-' . $counter;

            $existing_slug = Restaurant::where('slug', '=', $slug_to_save)->first();
            $counter++;
        }
        return $slug_to_save;
    }

    // regole di validazione
    protected function getValidatedRestaurant() {
        return [
            'name' => 'required|max:100',
            'address' => 'required|max:255',
            'types' => 'required|exists:types,id',
            'cover' => 'nullable|file|max:500000'
        ];
    }
}
