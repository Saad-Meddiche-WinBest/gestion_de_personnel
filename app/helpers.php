<?php

use Illuminate\Support\Facades\DB;

function filter_name($name)
{
    $filtred_name = '';

    $filtred_name = str_replace(['id', '_', ' '], ['', ' ', ''], $name);

    $filtred_name = ucfirst($filtred_name);

    return $filtred_name;
}

function fetch_options($name_of_table)
{

    if ($name_of_table) {

        $options = '';

        $data = DB::table($name_of_table)->get();

        foreach ($data as $option) {
        
            $options .= '<option value="' . $option->id . '">' . $option->nom . '</option>';
        }
        return $options;
    }
}
