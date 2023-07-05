<?php

use App\Models\Absence;
use App\Models\Personne;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

/*=========Function That Have Contact With DataBase=========*/

function  fetch_data_of_table($name_of_table, $id = null)
{
    try {
        $query = DB::table($name_of_table);

        if ($id !== null) {
            $query->where('id', $id);
        }

        $data = $query->get();
    } catch (QueryException $e) {
        abort(403, $e->getMessage());
    }

    return $data;
}

function insert_data_to_table($data, $name_of_table)
{

    try {

        $data = array_diff_key($data, array_flip(['_token', 'name_of_model', 'date_notification']));

        $id_of_last_row = DB::table($name_of_table)->insertGetId($data);
    } catch (QueryException $e) {

        abort(403, $e->getMessage());
    }

    return $id_of_last_row;
}

function update_data_of_table($new_data, $name_of_table, $id_of_row)
{
    try {

        $new_data = array_diff_key($new_data, array_flip(['_token', 'name_of_model', 'date_notification', '_method']));

        DB::table($name_of_table)->where('id', $id_of_row)->update($new_data);
    } catch (QueryException $e) {
        abort(403, $e->getMessage());
    }
}

function delete_data_from_table($name_of_table, $id_of_row)
{
    try {

        DB::table($name_of_table)->where('id', $id_of_row)->delete();
    } catch (QueryException $e) {
        if ($e->getCode() === '23000') {

            abort(403, 'Cannot delete the record due to a foreign key constraint violation.');
        } else {

            abort(403, "An error occurred while deleting the record.");
        }
    }
}

function fetch_personnes_with_this_poste($id_post)
{
    $name_of_model = 'personne';


    $data_of_table = Personne::where('id_poste', $id_post)->get();

    return view('index', compact(['data_of_table', 'name_of_model']));
}

function fetch_absence_in_this_period($from_date, $to_date)
{
    $name_of_model = 'absence';
    $name_of_table = 'absences';

    $data_of_table = Absence::whereBetween('date', [$from_date, $to_date])->get();

    return view('index', compact(['data_of_table', 'name_of_model']));
}
