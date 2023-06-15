<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\DynamicValidation;




class CrudController extends Controller
{

    public function index(Request $request)
    {
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {

            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        $responce_data = fetch_data_of_table($name_of_table);
        /*=====================================================================*/
        if (in_array('error', [$responce_data['status'], $responce_columns['status']])) {

            return back()->with('error', 'Table not found');
        }
        /*=====================================================================*/
        $data_of_table = $responce_data['content'];

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/


        return view('index', compact(['data_of_table', 'name_of_model', 'informations_of_columns']));
    }

    public function create(Request $request)
    {
        /*=====================================================================*/

        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/
        if (isset($request->extra_informations)) {

            $extra_informations = $request->extra_informations;

            Cache::forever('extra_informations', $extra_informations);
        }
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {

            return back()->with('error', 'Table not found');
        }
        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/

        return view('create', compact(['informations_of_columns', 'name_of_model']));
    }

    public function store(DynamicValidation $request)
    {

        $request = $request->validated();
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/
        if (Cache::has('extra_informations')) {

            $extra_informations = Cache::get('extra_informations');

            foreach ($extra_informations as $info) {
                $request[$info['column']] = $info['data'];
            }

            Cache::forget('extra_informations');
        }
        /*=====================================================================*/
        $responce_insert = insert_data_to_table($request->all(), $name_of_table);

        if ($responce_insert['status'] == 'error') {

            return back()->with('error', $responce_insert['content']);
        }

        $id_of_last_row = $responce_insert['content'];
        /*=====================================================================*/

        if ($name_of_model == 'personne' && isset($request->date_notification)) {
            $data = [
                'id_personne' => $id_of_last_row,
                'comment' => 'Le Stage touche à son fin',
                'date' => $request->date_notification
            ];

            Event::create($data);
        }
        /*=====================================================================*/

        return redirect('/dashboard');
    }


    public function show($id)
    {
        return view('welcome');
    }


    public function edit(Request $request, $id_of_row)
    {
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table, $id_of_row);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }
        $data_of_table = $responce_data['content'];

        $data_of_table = $data_of_table[0];
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/

        return view('edit', compact(['data_of_table', 'informations_of_columns', 'name_of_model']));
    }


    public function update(Request $request, $id_of_row)
    {
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/
        $responce_update = update_data_of_table($request->all(), $name_of_table, $id_of_row);

        if ($responce_update['status'] == 'error') {
            return back()->with('error', $responce_update['content']);
        }
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/
        return view('index', compact(['data_of_table', 'informations_of_columns', 'name_of_model']));
    }


    public function destroy(Request $request, $id_of_row)
    {
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/

        $responce_delete = delete_data_from_table($name_of_table, $id_of_row);

        if ($responce_delete['status'] == 'error') {
            return back()->with('error', $responce_delete['content']);
        }

        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/


        return view('index', compact(['data_of_table', 'name_of_model', 'informations_of_columns']));
    }
}
