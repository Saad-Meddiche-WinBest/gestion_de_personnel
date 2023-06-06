<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{

    public function index(Request $request)
    {
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');


        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $data = $New_Class::all();

        // return view($name_of_table . 's.index', compact('data'));

        return view('display', compact(['data', 'name_of_table']));
    }


    public function create()
    {
    }


    public function store(Request $request)
    {
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $New_Class::create($request->all());

        return view('welcome');
    }


    public function show($id)
    {
        return view('welcome');
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $data = $New_Class::findOrFail($id);
        $data->update($request->all());

        $data = $New_Class::all();


        return view('display', compact(['data', 'name_of_table']));
    }


    public function destroy(Request $request, $id)
    {
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $data = $New_Class::findOrFail($id);
        $data->delete();

        $data = $New_Class::all();


        return view('display', compact(['data', 'name_of_table']));
    }
}
