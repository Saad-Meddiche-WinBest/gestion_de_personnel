<?php

use App\Models\Personne;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

function filter_name($name)
{
    $filtred_name = '';

    $filtred_name = str_replace(['id_', ' ', '_'], ['', '', ' '], $name);

    $filtred_name = ucfirst($filtred_name);

    return $filtred_name;
}

function fetch_options($name_of_table, $id = Null)
{
    if (!$name_of_table) {
        return '';
    }

    $options = '';

    $data = DB::table($name_of_table)->get();
    $options .= sprintf('<option selected value="">Selectionner</option>');
    foreach ($data as $option) {
        $selected = select_option($id, $option->id);
        
        $options .= sprintf('<option value="%s" %s>%s</option>', $option->id, $selected, $option->nom);
    }
    

    return $options;
}

function fetch_columns($name_of_table)
{
    //Sources:https://stackoverflow.com/questions/18562684/how-to-get-database-field-type-in-laravel
    //Salah Starup


    $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($name_of_table);

    $columns = array_diff_key($columns, array_flip(['id', 'created_at', 'updated_at', 'password']));

    $foreignKeys = DB::select(DB::raw("SELECT 
        COLUMN_NAME, 
        CONSTRAINT_NAME, 
        REFERENCED_TABLE_NAME, 
        REFERENCED_COLUMN_NAME
        FROM 
        information_schema.key_column_usage
        WHERE 
        REFERENCED_TABLE_SCHEMA IS NOT NULL
        AND table_schema = DATABASE()
        AND table_name = '$name_of_table'"));

    $columnData = [];

    foreach ($columns as $column) {
        $columnData[] = [
            'name' => $column->getName(),
            'type' => $column->getType()->getName(),
            'comment' => $column->getComment(),
            'foreign_key' => get_foreign_key_details($column->getName(), $foreignKeys),
        ];
    }

    return $columnData;
}

function get_foreign_key_details($columnName, $foreignKeys)
{
    foreach ($foreignKeys as $foreignKey) {
        if ($foreignKey->COLUMN_NAME === $columnName) {
            return [
                'constraint_name' => $foreignKey->CONSTRAINT_NAME,
                'referenced_table' => $foreignKey->REFERENCED_TABLE_NAME,
                'referenced_column' => $foreignKey->REFERENCED_COLUMN_NAME,
            ];
        }
    }

    return null;
}

function choose_input($column, $data = null)
{
    $input = '<label>' . filter_name($column['name']) . '</label><br>';

    $comments = explode('-', $column['comment']);
    if ($comments[0] != 'grp1') {
        return;
    }

    if ($comments[1] == 'foreign') {
        $options = fetch_options($column['foreign_key']['referenced_table'], isset($data->{$column['name']}) ? $data->{$column['name']} : null);
        
        $input .= '<select name="' . $column['name'] . '">' . $options . '</select>';
        return $input;
    }

    if ($comments[1] == 'bool') {
        $selectedOption1 = select_option(isset($data->{$column['name']}) ? $data->{$column['name']} : null, 1);
        $selectedOption2 = select_option(isset($data->{$column['name']}) ? $data->{$column['name']} : null, 0);
        
       
        $options = '<option value="1" ' . $selectedOption1 . '>' . $comments[2] . '</option>';
        $options .= '<option value="0" ' . $selectedOption2 . '>' . $comments[3] . '</option>';

        $input .= '<select name="' . $column['name'] . '">' . $options . '</select>';

        return $input;
    }

    $input .= '<input type="' . $comments[1] . '" name="' . $column['name'] . '" value="' . (isset($data->{$column['name']}) ? $data->{$column['name']} : '') . '">';
    return $input;
}

function select_option($a, $b)
{
    return $a === $b ? 'selected' : '';
}

function choose_data($looking_for, $column)
{
    $comments = explode('-', $column['comment']);

    if ($comments[1] == 'foreign') {
        $referenced_table = $column['foreign_key']['referenced_table'];
        $data = DB::table($referenced_table)->where('id', $looking_for)->value('nom');
        return $data;
    }

    if ($comments[1] == 'bool') {
        switch ($looking_for) {
            case 1:
                return $comments[2];
            case 0:
                return $comments[3];
        }
    }


    return $looking_for;
}

function fetch_post($id_post)
{
    $name_of_model = 'personne';
    $data = Personne::where('id_poste', $id_post)->get();
    $columnData = fetch_columns('personnes');
    return view('index', compact(['data', 'name_of_model', 'columnData']));
}
