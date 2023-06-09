<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{

    public function index(Request $request)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');

         $columnData=fetch_columns($name_of_model.'s');
        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::all();

        return view('index', compact(['data', 'name_of_model','columnData']));
    }

    public function create(Request $request)
    {

        $name_of_table = $request->name_of_model . 's';
        $name_of_model = $request->name_of_model;
        
        $columnData = fetch_columns($name_of_table);

        return view('create', compact(['columnData', 'name_of_model']));
    } 

    public function store(Request $request)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');
        // dd($request->all());
        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
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
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::findOrFail($id);
        $data->update($request->all());

        $data = $New_Class::all();


        return view('display', compact(['data', 'name_of_model']));
    }


    public function destroy(Request $request, $id)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::findOrFail($id);
        $data->delete();

        $data = $New_Class::all();

        return view('display', compact(['data', 'name_of_model']));
    }
}
