<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'Category name is required'
            ]
        );
        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug', $slug)->first();
        while ($checkSlug) {
            $slug = $checkSlug->slug .  Str::random(2);
        }
        Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        return redirect()->route('admin.category.index')->with('success', 'Create Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        // dd($category->name);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'Category name is required'
            ]
        );
        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug', $slug)->first();
        while ($checkSlug) {
            $slug = $checkSlug->slug . Str::random(2);
        }
        // $category = Category::find($id);
        // $category->update([
        //     'name' => $request->name,
        //     'slug' => $slug,
        // ]); Hoặc cách dưới!!
        Category::where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);
        return redirect()->route('admin.category.edit', $id)->with('success', 'Update Successfully');
    }

    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('admin.category.index')->with('success', 'Delete Successfully');
    }
}
