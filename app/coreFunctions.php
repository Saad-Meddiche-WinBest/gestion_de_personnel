<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

/*=========Function That Have Contact With DataBase=========*/

function fetch_data_of_table($name_of_table, $id = null)
{
    try {
        $query = DB::table($name_of_table);

        if ($id !== null) {
            $query->where('id', $id);
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
    $rules = [];

    foreach ($data as $key => $value) {
        $rules[$key] = 'required|max:255';
    }

    $validator = Validator::make($data, $rules);

    if ($validator->fails()) {
        return [
            'status' => 'error',
            'content' => 'Validation failed: ' . $validator->errors()->first()
        ];
    }

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
