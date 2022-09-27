<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dish;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();

        $data = [
            'dishes' => $dishes
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
        return view('admin.dishes.create');
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

        $new_dish = new Dish();
        // dd($form_data);
        if(isset($form_data['is_visible'])){
            $new_dish->is_visible = 1;
        } else{
            $new_dish->is_visible = 0;
        }

        $new_dish->fill($form_data);
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

        $data = [
            'dishes' => $dishes
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

        $data = [
            'dish' => $dish
        ];
        return view('admin.dishes.edit', $data);
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

        return redirect()->route('admin.dishes.index');
    }

    protected function getValidationRules(){
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:60000',
            'price' => 'required|numeric|min:0',
            // 'is_visible' => 'required',
            'cover' => 'nullable|max:1024'
        ];
    }
}
