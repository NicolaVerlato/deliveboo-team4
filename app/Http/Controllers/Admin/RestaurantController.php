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
        $user = Auth::user();
        $restaurants = Restaurant::where('user_id', '=', $user->id)->get();
        $now = Carbon::now();
        $restaurantLink = Restaurant::find($user->id);

        $data = [
            'restaurants' => $restaurants,
            'now' => $now,
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
        $types = Type::all();

        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidatedRestaurant());

        $form_data = $request->all();

        if(isset($form_data['cover'])) {
            $img_path = Storage::put('restaurants-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }

        $user = Auth::user();

        $new_restaurant = new Restaurant;
        $new_restaurant->fill($form_data);

        $new_restaurant->slug = $this->getSlugFromTitle($new_restaurant->name);
        $new_restaurant->user_id = $user->id;

        $new_restaurant->save();

        if(isset($form_data['types'])) {
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
        $restaurantLink = Restaurant::find($user->id);

        $data = [
            'restaurant' => $restaurant,
            'now' => $now,
            'restaurantLink' => $restaurantLink
        ];

        return view('admin.restaurants.show', $data);
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
        // $restaurant_to_delete = Restaurant::findOrFail($id);

        // if($restaurant_to_delete->cover) {
        //     Storage::delete($restaurant_to_delete->cover);
        // }

        // $restaurant_to_delete->types()->sync([]);

        // $restaurant_to_delete->delete();

        // return redirect()->route('admin.restaurants.index');
    }

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

    protected function getValidatedRestaurant() {
        return [
            'name' => 'required|max:100',
            'address' => 'required|max:255',
            'types' => 'nullable|exists:types,id',
            'cover' => 'nullable|file|max:500000'
        ];
    }
}
