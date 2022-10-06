<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dati utente loggato
        $user = Auth::user();
        $page_data = $request->all();
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        // prendo i piatti dell'utente loggato comparando sempre la FK
        $dishes = Dish::where('restaurant_id', '=', $restaurant[0]->id)->paginate(6);
        // variabile per controllare se l'account ha già un ristorante
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        $deleted = isset($page_data['deleted']) ? $page_data['deleted'] : null;

        $data = [
            'dishes' => $dishes,
            'restaurant' => $restaurant,
            'restaurantLink' => $restaurantLink,
            'deleted' => $deleted
        ];

        return view('admin.dishes.index', $data);
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
        // prendo il ristorante dell'utente loggato
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        // variabile per controllare se l'account ha già un ristorante nella dashboard
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        $data = [
            'restaurant' => $restaurant,
            'restaurantLink' => $restaurantLink
        ];

        // se l'account loggato non ha un ristorante
        if($restaurantLink === null) {
            // gli torno la pagina di errore di mancata creazione ristorante
            return view('admin.dishes.errors.createerror', $data);
        } else {
            // altrimenti gli torno la pagina della creazione piatti
            return view('admin.dishes.create', $data);
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
        // valido request
        $request->validate($this->getValidationRules());
        // passo in form data la richiesta
        $form_data = $request->all();

        // prendo dati utente loggato
        $user = Auth::user();
        // prendo il ristorante dell'utente loggato
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();

        $new_dish = new Dish();

        // se in formdata è presente un'immagine
        if(isset($form_data['cover'])) {
            // la carico nel DB
            $img_path = Storage::put('dishes-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }
        // } else{
        //     $img_path = asset('storage/' . 'default-image.jpeg');
        //     $new_dish->cover = $img_path;
        // }

        // se in formdata la abbiamo is_visible
        if(isset($form_data['is_visible'])){
            // vuol dire che il piatto è visibile quindi diamo valore 1
            $new_dish->is_visible = 1;
        } else{
            // altrimenti non è visibile e mettiamo 0
            $new_dish->is_visible = 0;
        }

        $new_dish->fill($form_data);
        // la FK restaurant_id nella tabellla dishes è uguale all'id del ristorante
        $new_dish->restaurant_id = $restaurant[0]->id;
        $new_dish->save();

        return redirect()->route('admin.dishes.show', ['dish' => $new_dish->id, 'saved' => 'yes']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $dishes = Dish::findOrFail($id);
        $user = Auth::user();
        $page_data = $request->all();
        $saved = isset($page_data['saved']) ? $page_data['saved'] : null;
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        // variabile per controllare se l'account ha già un ristorante nella dashboard
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        $data = [
            'dishes' => $dishes,
            'restaurant' => $restaurant,
            'restaurantLink' => $restaurantLink,
            'saved' =>$saved
        ];
       
        return view('admin.dishes.show', $data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dish = Dish::findOrFail($id);
        // dati utente loggato
        $user = Auth::user();
        // prendo il ristorante dell'account loggato
        $restaurant = Restaurant::findOrFail($user->id);
        // variabile per controllare se l'account ha già un ristorante nella dashboard
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        // se la FK restaurant_id in dishes è uguale all'id del ristorante dell'utente loggato
        if($dish->restaurant_id == $restaurant->id) {
            // prendo il piatto in questione
            $dish = Dish::findOrFail($id);
            // lo passo alla view
            $data = [
                'dish' => $dish,
                'restaurant' => $restaurant,
                'restaurantLink' => $restaurantLink
            ];
            // e ritorno la view per editare
            return view('admin.dishes.edit', $data);
        } else {
            // altrimenti
            $data = [
                'restaurant' => $restaurant,
                // passo sempre l'informazione che serve alla dashboard
                'restaurantLink' => $restaurantLink
            ];
            // e ritorno la view che spiega l'errore
            return view('admin.dishes.errors.error', $data);
        }
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
        // valido il piatto da aggiornare 
        $request->validate($this->getValidationRules());
        // popolo form_data con la request che contiene tutti i dati del form
        $form_data = $request->all();

        // prendo il piatto da aggiornare
        $dish_to_update = Dish::findOrFail($id);

        // se in form data abbiamo un'immagine
        if(isset($form_data['cover'])){
            // e c'è un'immagine preesistente 
            if($dish_to_update->cover){
                // la cancello
                Storage::delete($dish_to_update->cover);
            }

            // e salvo quella nuova
            $img_path = Storage::put('dishes-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }

        // se in form_data abbiamo un attributo is_visible
        if(isset($form_data['is_visible'])){
            // vuol dire che il piatto è visibile quindi metto valore 1
            $dish_to_update->is_visible = 1;
        } else {
            // altrimenti non è visibile e metto 0
            $dish_to_update->is_visible = 0;
        }
        // aggiorno il post
        $dish_to_update->update($form_data);

        return redirect()->route('admin.dishes.show', ['dish' => $dish_to_update->id, 'saved' => 'yes']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // prendo il post da eliminare
        $dish_to_destroy = Dish::findOrFail($id);

        // se ha un'immagine
        if($dish_to_destroy->cover) {
            // la elimino
            Storage::delete($dish_to_destroy->cover);
        }

        // cancello il piatto
        $dish_to_destroy->delete();

        return redirect()->route('admin.dishes.index', ['deleted' => 'yes']);
    }

    // regole di validazione
    protected function getValidationRules(){
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:60000',
            'price' => 'required|numeric|min:0',
            'cover' => 'nullable|image|mimes:jpeg,jpg,bmp,png'
        ];
    }
}