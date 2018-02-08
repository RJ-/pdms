<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\CollegeCampus;
use App\Category;
use App\Field;
use Session;


class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $counter = 1;
        // $field = Field::all();
        // return view('admin-dashboard.pages.fields.index')->withFields($field)->withCounter($counter);
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
          'name' => 'required'
        ));
        $field = new Field;

        $field->name = $request->name;

        $field->category()->associate($request->category_id);

        $field->save();

        Session::flash('success', 'New Field was successfully created!');

        return redirect()->route('category.show', $field->category_id);
    }

    public function addOtherFields(Request $request)
    {
        $this->validate($request, array(
          'name' => 'required'
        ));

        $other = Category::where('name','Others')->value('id');

        $check = Field::where('name', $request->name)->first();

        if ($check != NULL) {
          return redirect()->back()->with('error', 'Field already exist. Go to Manage Profile Setting');
        }else{
          $field = new Field;

          $field->name = $request->name;

          $field->category()->associate($other);

          $field->save();

          $faculty = DB::table('faculty_field')
                ->insert(['faculty_id' => $request->faculty_id , 'field_id' => $field->id]);

          Session::flash('success', 'New field of specialization was successfully created!');

          return redirect()->route('faculty.show',$request->faculty_id);
        }

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
        $field = Field::find($id);
        $counter = 1;
        return view('admin-dashboard.pages.fields.show')
                ->withFields($field)->withCounter($counter)
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
        $field = Field::find($id);
        return view('admin-dashboard.pages.fields.edit')->withFields($field)
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

        $field = Field::find($id);
        $this->validate($request, ['name' => 'required|max:255']);

        $field->name = $request->name;
        $field->category_id = $request->category_id;
        $field->save();

        Session::flash('success', 'You have successfully updated the field!');

        return redirect()->route('field.show', $field->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $field = Field::find($id);

      $field->activity()->detach();
      $field->faculty()->detach();

      $field->delete();
      Session::flash('success', 'Field was deleted successfully');

      return redirect()->route('category.show', $field->category_id);
    }
}
