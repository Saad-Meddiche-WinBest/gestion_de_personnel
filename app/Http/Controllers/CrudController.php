<?php

namespace App\Http\Controllers;

use App\Models\Expiration;
use Illuminate\Http\Request;
// use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\View;


class CrudController extends Controller
{

    public function index(Request $request)
    {

        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';

        $responce_columns = fetch_columns_of_table($name_of_table);

        $responce_data = fetch_data_of_table($name_of_table);

        if (in_array('error', [$responce_data['status'], $responce_columns['status']])) {
            return back()->with('error', 'Table not found');
        }

        $data_of_table = $responce_data['content'];
        $informations_of_columns = $responce_columns['content'];

        return view('index', compact(['data_of_table', 'name_of_model', 'informations_of_columns']));
    }

    public function create(Request $request)
    {

        if (isset($request->extra_informations)) {

            $extra_informations = $request->extra_informations;

            Cache::forever('extra_informations', $extra_informations);
        }

        $name_of_table = $request->name_of_model . 's';
        $name_of_model = $request->name_of_model;

        $columnData = fetch_columns_of_table($name_of_table);

        return view('create', compact(['columnData', 'name_of_model']));
    }

    public function store(Request $request)
    {
        if (Cache::has('extra_informations')) {

            $extra_informations = Cache::get('extra_informations');

            foreach ($extra_informations as $info) {
                $request[$info['column']] = $info['data'];
            }

            Cache::forget('extra_informations');
        }

        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $obj = $New_Class::create($request->all());

        if ($name_of_model == 'personne') {
            $data = [
                'id_personne' => $obj->id,
                'comment' => 'Le Stage touche à son fin',
                'date' => $request->date_notification
            ];

            Expiration::create($data);
        }

        return redirect('/dashboard');
    }


    public function show($id)
    {
        return view('welcome');
    }


    public function edit(Request $request, $id)
    {
        $name_of_table = $request->name_of_model . 's';
        $name_of_model = $request->name_of_model;

        //Fetch Data
        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::where('id', $id)->get();

        //Fetch Columns
        $columnData = fetch_columns_of_table($name_of_table);

        return view('edit', compact(['data', 'columnData', 'name_of_model']));
    }


    public function update(Request $request, $id)
    {
        $name_of_model = $request->name_of_model;
        $name_of_table = $request->name_of_model . 's';


        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::findOrFail($id);

        $data->update($request->all());

        $columnData = fetch_columns_of_table($name_of_table);

        $data = $New_Class::all();


        return view('index', compact(['data', 'columnData', 'name_of_model']));
    }


    public function destroy(Request $request, $id)
    {
        $name_of_model = $request->name_of_model;
        $name_of_table = $request->name_of_model . 's';


        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);

        try {
            $data = $New_Class::findOrFail($id);
            $data->delete();
        } catch (QueryException $e) {
            // Handle the exception
            if ($e->getCode() === '23000') {
                // Handle the foreign key constraint violation error
                return back()->with('error', 'Cannot delete the record due to a foreign key constraint violation.');
            } else {
                // Handle other database-related errors
                return back()->with('error', 'An error occurred while deleting the record.');
            }
        }


        $columnData = fetch_columns_of_table($name_of_table);

        $data = $New_Class::all();

        return view('index', compact(['data', 'name_of_model', ['columnData']]));
    }
}
