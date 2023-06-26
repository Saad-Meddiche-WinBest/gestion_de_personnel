<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

function color_expired_event($name_of_model, $column, $data)
{
    if ($name_of_model == 'event' && $column['name'] == 'date' && $data->{$column['name']} == Carbon::today()->format('Y-m-d')) {
        echo 'style="background-color: grey"';
    }
}

function check_existence($name_of_table, $column, $data)
{
    $id = DB::table($name_of_table)->where($column, $data)->first();
    return $id;
}
