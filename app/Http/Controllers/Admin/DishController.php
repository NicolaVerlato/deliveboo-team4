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
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        // $restaurant = Restaurant::findOrFail($user->id);
        // $dishes = Dish::where('restaurant_id', '=', $user->id)->get();
        $dishes = Dish::where('restaurant_id', '=', $user->id)->paginate(6);
        $restaurantLink = Restaurant::find($user->id);

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
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        $restaurantLink = Restaurant::find($user->id);

        $data = [
            'restaurant' => $restaurant,
            'restaurantLink' => $restaurantLink
        ];
        return view('admin.dishes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->getValidationRules());
        $form_data = $request->all();

        if(isset($form_data['cover'])) {
            $img_path = Storage::put('dishes-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }

        $user = Auth::user();
        // $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        $restaurant = Restaurant::findOrFail($user->id);
        // dd($restaurant->id);

        $new_dish = new Dish();

        if(isset($form_data['is_visible'])){
            $new_dish->is_visible = 1;
        } else{
            $new_dish->is_visible = 0;
        }

        $new_dish->fill($form_data);
        $new_dish->restaurant_id = $restaurant->id;
        $new_dish->save();

        return redirect()->route('admin.dishes.show', ['dish' => $new_dish->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dishes = Dish::findOrFail($id);
        $user = Auth::user();
        $restaurant = Restaurant::where('user_id', '=', $user->id)->get();
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        $data = [
            'dishes' => $dishes,
            'restaurant' => $restaurant,
            'restaurantLink' => $restaurantLink
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
        $user = Auth::user();
        $restaurant = Restaurant::findOrFail($user->id);
        $restaurantLink = Restaurant::where('user_id', '=', $user->id)->get();

        if($dish->restaurant_id == $restaurant->id) {

            $dish = Dish::findOrFail($id);
            
            $data = [
                'dish' => $dish,
                'restaurant' => $restaurant,
                'restaurantLink' => $restaurantLink
            ];

            return view('admin.dishes.edit', $data);
        } else {
            $dish = Dish::findOrFail(null);

            $data = [
                'dish' => $dish,
                'restaurant' => $restaurant,
                'restaurantLink' => $restaurantLink
            ];

            return view('admin.dishes.edit', $data);
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
        $request->validate($this->getValidationRules());
        $form_data = $request->all();

        $dish_to_update = Dish::findOrFail($id);

        if(isset($form_data['cover'])){
            if($dish_to_update->cover){
                Storage::delete($dish_to_update->cover);
            }

            $img_path = Storage::put('dishes-covers', $form_data['cover']);
            $form_data['cover'] = $img_path;
        }

        if(isset($form_data['is_visible'])){
            $dish_to_update->is_visible = 1;
        } else {
            $dish_to_update->is_visible = 0;
        }
        $dish_to_update->update($form_data);

        return redirect()->route('admin.dishes.show', ['dish' => $dish_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dish_to_destroy = Dish::findOrFail($id);

        if($dish_to_destroy->cover) {
            Storage::delete($dish_to_destroy->cover);
        }

        $dish_to_destroy->delete();

        return redirect()->route('admin.dishes.index', ['deleted' => 'yes']);
    }

    protected function getValidationRules(){
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:60000',
            'price' => 'required|numeric|min:0',
            'cover' => 'nullable|max:500000'
        ];
    }
}
