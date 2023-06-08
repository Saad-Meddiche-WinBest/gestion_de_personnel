<?php

use Illuminate\Support\Facades\DB;

function filter_name($name)
{
    $filtred_name = '';

    $filtred_name = str_replace(['id_', ' ', '_'], ['', '', ' '], $name);

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

function choose_input($column)
{
    $input = '<label>' . filter_name($column['name']) . '</label><br>';

    $comments = explode('-', $column['comment']);

    if ($comments[0] != 'grp1') {
        return;
    }

    if ($comments[1] == 'foreign') {
        $input .= '<select name="' . $column['name'] . '">' . fetch_options($column['foreign_key']['referenced_table']) . '</select>';
        return $input;
    }

    if ($comments[1] == 'bool') {

        $options = '<option value="1">' . $comments[2] . '</option>';
        $options .= '<option value="0">' . $comments[3] . '</option>';

        $input .= '<select name="' . $column['name'] . '">' . $options . '</select>';

        return $input;
    }

    $input .= '<input type="' . $comments[1] . '" name="' . $column['name'] . '">';
    return $input;
}
