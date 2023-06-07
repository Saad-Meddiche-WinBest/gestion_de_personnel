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
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');


        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $data = $New_Class::all();

        return view('display', compact(['data', 'name_of_table']));
    }


    // public function create(Request $request)
    // {
    //     $name_of_table = $request->tablename;

    //     $columns = Schema::getColumnListing($name_of_table . 's');
    //     $columns = array_diff($columns, ['id', 'created_at', 'updated_at']);

    //     return view('create', compact(['columns', 'name_of_table']));
    // }
    public function create(Request $request)
    {

        $name_of_table = $request->tablename . 's';

        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableColumns($name_of_table);
        unset($columns['id']);
        unset($columns['created_at']);
        unset($columns['updated_at']);

        $foreignKeys = DB::select(DB::raw("SELECT 
        COLUMN_NAME, 
        CONSTRAINT_NAME, 
        REFERENCED_TABLE_NAME, 
        REFERENCED_COLUMN_NAME
        FROM 
        information_schema.key_column_usage
        WHERE 
        table_schema = DATABASE()
        AND table_name = '$name_of_table'"));

        $columnData = [];

        foreach ($columns as $column) {
            $columnData[] = [
                'name' => $column->getName(),
                'type' => $column->getType()->getName(),
                'default' => $column->getDefault(),
                'foreign_key' => $this->getForeignKeyDetails($column->getName(), $foreignKeys),
            ];
        }

        return view('create', compact(['columnData', 'name_of_table']));

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
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
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
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $data = $New_Class::findOrFail($id);
        $data->update($request->all());

        $data = $New_Class::all();


        return view('display', compact(['data', 'name_of_table']));
    }


    public function destroy(Request $request, $id)
    {
        $name_of_table = $request->tablename;

        if ($name_of_table == null) return view('welcome');

        $New_Class = 'App\\Models\\' . ucfirst($name_of_table);
        $data = $New_Class::findOrFail($id);
        $data->delete();

        $data = $New_Class::all();


        return view('display', compact(['data', 'name_of_table']));
    }
}
