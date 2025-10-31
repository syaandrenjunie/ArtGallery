<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index() {
        
        $categories = Category::latest('updated_at')->paginate(5);

        return view('categories.index', [
            'categories' => $categories
        ]);

    }

    public function create() {

        return view('categories.create');

    }

    public function store() {

        //validate
        request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        //authorize 
        //create
        Category::create([
            'name' =>  request('name'),
            'description' => request('description'),

        ]);

        //redirect
        return redirect('/categories');

    }

    public function show(Category $category) {
        return view('categories.show', [
            'category' => $category
        ]);

    }

    public function edit(Category $category) {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    public function update(Category $category) {
        //validate
        request()->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        //update
        $category->name = request('name');
        $category->description = request('description');

        //persist
        $category->save();

        //redirect
        return redirect('/categories/'. $category->id);
    }

    public function destroy(Category $category) {

        $category->delete();

        return redirect('/categories');

    }
}
