<?php

namespace App\Http\Controllers;



use Carbon\Carbon;

use App\Models\Post;
use App\Models\User;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\DynamicValidation;





class CrudController extends Controller
{
    public $name_of_model;
    public $name_of_table;
    public $class;

    function __construct(Request $request)
    {
        $name_of_model = $request->name_of_model;

        $class = 'App\\Models\\' . ucfirst($name_of_model);

        if (!class_exists($class)) {
            abort(403, 'The Record :"' . $class . '" is not found');
        }

        $this->name_of_model = $name_of_model;
        $this->name_of_table = $name_of_model . 's';
        $this->class = $class;
    }

    public function index(Request $request)
    {
        $this->authorize('viewAll', $this->class);

        return view('index', [
            'name_of_model' => $this->name_of_model,
        ]);
    }

    public function create(Request $request)
    {
        $this->authorize('create', $this->class);

        if (isset($request->extra_informations)) {

            $extra_informations = $request->extra_informations;

            Cache::forever('extra_informations', $extra_informations);
        } else {
            Cache::forget('extra_informations');
        }

        return view('create', [
            'name_of_model' => $this->name_of_model,
        ]);
    }

    public function store(DynamicValidation $request)
    {
        $this->authorize('create', $this->class);

        $data = (object) $request->validated();

        if (Cache::has('extra_informations')) {

            $extra_informations = Cache::get('extra_informations');


            foreach ($extra_informations as $info) {
               
                $data->{$info['column']} = $info['data'];
            }

            Cache::forget('extra_informations');
        }

        $id_of_last_row = insert_data_to_table((array) $data, $this->name_of_table);

        if (isset($data->date_notification)) {
            $data = [
                'id_personne' => $id_of_last_row,
                'comment' => 'Le Stage touche à son fin',
                'date' => $data->date_notification
            ];

            Event::create($data);
        }

        return view('index', [
            'name_of_model' => $this->name_of_model,
        ]);
    }

    public function show($id)
    {
        return view('welcome');
    }

    public function edit($id_of_row)
    {

        $this->authorize('update', $this->class);

        $data_of_table = fetch_data_of_table($this->name_of_table, $id_of_row);

        return view('edit', [
            'name_of_model' => $this->name_of_model,
            'data_of_table' => $data_of_table[0]
        ]);
    }

    public function update(DynamicValidation $request, $id_of_row)
    {
        $request->merge(['id' => $id_of_row]);

        $this->authorize('update', $this->class);

        $data = (object) $request->validated();

        update_data_of_table((array) $data, $this->name_of_table, $id_of_row);

        return view('index', [
            'name_of_model' => $this->name_of_model
        ]);
    }

    public function destroy($id_of_row)
    {
        $this->authorize('destroy', $this->class);

        delete_data_from_table($this->name_of_table, $id_of_row);

        return view('index', [
            'name_of_model' => $this->name_of_model,
        ]);
    }
}
