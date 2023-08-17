<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $food = Food::paginate(10);
        return view('food.index', ['food' => $food]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'types' => ['required', 'string'],
            'description' => ['required', 'string',],
            'price' => ['required', 'numeric', 'min:2'],            
            'rate' => ['required', 'numeric', 'min:2']
        ]);
        $data = $request->all();
        $data['picturePath'] = $request->file('picturePath')->store('assets/product', 'public');
        Food::create($data);
        return view('food.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        return view('food.edit', ['item' => $food]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Food $food)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'types' => ['required', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:2'],            
            'rate' => ['required', 'numeric', 'min:2']

        ]);
        $data = $request->all();
        if ($request->file('picturePath')) {
            $data['picturePath'] = $request->file('picturePath')->store('assets/product', 'public');
        }
        $food->update($data);
        return redirect()->route('foods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return redirect()->route('foods.index');
    }
}
