<?php

use App\Models\Personne;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

/*=========Function That Have Contact With DataBase=========*/

function fetch_data_of_table($name_of_table, $id = null)
{
    try {
        $query = DB::table($name_of_table);

        if ($id !== null) {
            $query->where('id', $id);
        }
        
        if($id !== null && $id == 0){
            return [
                'status' => 'error',
                'content' => "Fetching failed: you have no access "
            ];
        }
        $data = $query->get();
    } catch (QueryException $e) {
        return [
            'status' => 'error',
            'content' => "Fetching failed: " . $e->getMessage()
        ];
    }

    return [
        'status' => 'ok',
        'content' => $data
    ];
}

function insert_data_to_table($data, $name_of_table)
{

    try {
        $data = array_diff_key($data, array_flip(['_token', 'name_of_model', 'date_notification']));

        $id_of_last_row = DB::table($name_of_table)->insertGetId($data);
    } catch (QueryException $e) {
        return [
            'status' => 'error',
            'content' => "Insertion failed: " . $e->getMessage()
        ];
    }

    return [
        'status' => 'ok',
        'content' => $id_of_last_row
    ];
}

function update_data_of_table($new_data, $name_of_table, $id_of_row)
{
    try {
        $new_data = array_diff_key($new_data, array_flip(['_token', 'name_of_model', 'date_notification', '_method']));

        DB::table($name_of_table)->where('id', $id_of_row)->update($new_data);
    } catch (QueryException $e) {
        return [
            'status' => 'error',
            'content' => "Updating failed: " . $e->getMessage()
        ];
    }

    return [
        'status' => 'ok',
    ];
}

function delete_data_from_table($name_of_table, $id_of_row)
{
    try {
        DB::table($name_of_table)->where('id', $id_of_row)->delete();
    } catch (QueryException $e) {
        if ($e->getCode() === '23000') {
            return [
                'status' => 'error',
                'content' => "Deleting failed: Cannot delete the record due to a foreign key constraint violation."
            ];
        } else {
            return [
                'status' => 'error',
                'content' => "Deleting failed: An error occurred while deleting the record."
            ];
        }
    }

    return [
        'status' => 'ok',
    ];
}

function fetch_personnes_with_this_poste($id_post)
{
    $name_of_model = 'personne';
    $name_of_table = 'personnes';

    $data_of_table = Personne::where('id_poste', $id_post)->get();

    $responce_columns = fetch_columns_of_table($name_of_table);

    if ($responce_columns['status'] == 'error' || empty($responce_columns['content'])) {


        return back()->with('error', 'Table not found');
    }

    $informations_of_columns = $responce_columns['content'];

    return view('index', compact(['data_of_table', 'name_of_model', 'informations_of_columns']));
}
