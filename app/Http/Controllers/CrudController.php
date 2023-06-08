<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{

    public function index(Request $request)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');


        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::all();

        return view('display', compact(['data', 'name_of_model']));
    }

    public function create(Request $request)
    {

        $name_of_table = $request->name_of_model . 's';
        $name_of_model = $request->name_of_model;

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
                'foreign_key' => $this->getForeignKeyDetails($column->getName(), $foreignKeys),
            ];
        }

        return view('create', compact(['columnData', 'name_of_model']));
    }

    private function getForeignKeyDetails($columnName, $foreignKeys)
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

    public function store(Request $request)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');
        // dd($request->all());
        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $New_Class::create($request->all());

        return view('welcome');
    }


    public function show($id)
    {
        return view('welcome');
    }


    public function edit($id)
    {
    }


    public function update(Request $request, $id)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::findOrFail($id);
        $data->update($request->all());

        $data = $New_Class::all();


        return view('display', compact(['data', 'name_of_model']));
    }


    public function destroy(Request $request, $id)
    {
        $name_of_model = $request->name_of_model;

        if ($name_of_model == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_model);
        $data = $New_Class::findOrFail($id);
        $data->delete();

        $data = $New_Class::all();

        return view('display', compact(['data', 'name_of_model']));
    }
}
