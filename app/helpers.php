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
    ['grp1','text'];
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

function fetch_columns($name_of_table){
        //Sources:https://stackoverflow.com/questions/18562684/how-to-get-database-field-type-in-laravel
        //Salah Starup

      
        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($name_of_table);

        $columns = array_diff_key($columns, array_flip(['id', 'created_at', 'updated_at']));

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
                'foreign_key' => getForeignKeyDetails($column->getName(), $foreignKeys),
            ];
        }
        
        return $columnData;
}

function getForeignKeyDetails($columnName, $foreignKeys)
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

function fetch_post($id_post){
    $name_of_model = 'personne';
    $data = Personne::where('id_poste' ,$id_post )->get();
    $columnData = fetch_columns('personnes');
    return view('index', compact(['data', 'name_of_model','columnData']));
}