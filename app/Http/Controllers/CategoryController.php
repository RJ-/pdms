<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CollegeCampus;
use App\Category;
use App\Field;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $counter = 1;
        $college = CollegeCampus::all();
        $category = Category::all();
        return view('admin-dashboard.pages.categories.index')
          ->withCategories($category)
          ->withCounter($counter)
          ->with('colleges', $college);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));

        $category = new Category;
        $category->name = $request->name;

        $category->save();

        Session::flash('success', 'New Category was successfully created!');

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $college = CollegeCampus::all();
        $category = Category::find($id);
        $counter = 1;
        return view('admin-dashboard.pages.categories.show')
            ->withCategories($category)
            ->withCounter($counter)
            ->with('colleges', $college);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $college = CollegeCampus::all();
        $category = Category::find($id);
        return view('admin-dashboard.pages.categories.edit')
                ->withCategory($category)
                ->with('colleges', $college);
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
        $category = Category::find($id);
        $this->validate($request, ['name' => 'required|max:255']);

        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'You have successfully updated the category!');

        return redirect()->route('category.show', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);

      $category->delete();
      Session::flash('success', 'Category was deleted successfully');

      return redirect()->route('category.index');
    }
}
