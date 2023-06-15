<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

/*=========Function That Have Contact With DataBase=========*/

function fetch_data_of_table($name_of_table)
{
    try {
        $data = DB::table($name_of_table)->get();
    } catch (QueryException $e) {
        return [
            'status' => 'error',
            'content' => 'Table Not Found'
        ];
    }

    return [
        'status' => 'ok',
        'content' => $data
    ];
}
