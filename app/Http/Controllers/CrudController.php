<?php

namespace App\Http\Controllers;


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
    public function getRoleId(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $user = User::find($user_id);
        $role_id = $user->roles->pluck('id')->first();
    
        // Use the $role_id as needed
        // ...
    
        return response()->json(['role_id' => $role_id]);
    }
    public function index(Request $request)
    {
        /*=====================================================================*/
        if (isset($_GET['user_id'])) {
            $path1 = $_GET['user_id'];
            $request->session()->put('user_id', $path1);
        }
        /*=====================================================================*/

        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {

            return back()->with('error', 'Name Of Model Is Empty');
        }
       
        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/

        $model = 'App\\Models\\'. ucfirst($name_of_model);
        $this->authorize('viewAll', $model);
        
        /*=====================================================================*/

        $responce_columns = fetch_columns_of_table($name_of_table);

        $responce_data = fetch_data_of_table($name_of_table);
        /*=====================================================================*/
        if (in_array('error', [$responce_data['status'], $responce_columns['status']])) {

            return back()->with('error', 'Table not found');
        }
        /*=====================================================================*/
        $data_of_table = $responce_data['content'];


        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/

        return view('index', compact(['data_of_table', 'name_of_model', 'informations_of_columns']));
    }
        public function markNotification(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    public function create(Request $request)
    {
        
        /*=====================================================================*/

        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
        /*=====================================================================*/
        $model = 'App\\Models\\'. ucfirst($name_of_model);
        $this->authorize('create', $model);

        /*=====================================================================*/

        if (isset($request->extra_informations)) {

            $extra_informations = $request->extra_informations;

            Cache::forever('extra_informations', $extra_informations);
        }
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {

            return back()->with('error', 'Table not found');
        }
        $informations_of_columns = $responce_columns['content'];


       
        /*=====================================================================*/

        return view('create', compact(['informations_of_columns', 'name_of_model']));
    }

    public function store(DynamicValidation $request)
    {

        $data = (object) $request->validated();

        /*=====================================================================*/
        $name_of_model = $data->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $data->name_of_model . 's';
        /*=====================================================================*/

        $model = 'App\\Models\\'. ucfirst($name_of_model);
        $this->authorize('create', $model);

        /*=====================================================================*/
        if (Cache::has('extra_informations')) {

            $extra_informations = Cache::get('extra_informations');

            foreach ($extra_informations as $info) {
                $data->{$info['column']} = $info['data'];
            }

            Cache::forget('extra_informations');
        }
        /*=====================================================================*/
        $responce_insert = insert_data_to_table((array) $data, $name_of_table);

        if ($responce_insert['status'] == 'error') {

            return back()->with('error', $responce_insert['content']);
        }

        $id_of_last_row = $responce_insert['content'];
        /*=====================================================================*/

        if ($name_of_model == 'personne' && isset($data->date_notification)) {
            $data = [
                'id_personne' => $id_of_last_row,
                'comment' => 'Le Stage touche à son fin',
                'date' => $data->date_notification
            ];

            Event::create($data);
        }
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/
        return view('index', compact(['data_of_table', 'informations_of_columns', 'name_of_model']));
    }

    public function show($id)
    {
        return view('welcome');
    }

    public function edit(Request $request, $id_of_row)
    {

        
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';

        /*=====================================================================*/

        $model = 'App\\Models\\'. ucfirst($name_of_model);
        $this->authorize('update', $model);
        
        /*=====================================================================*/

        // $id = Auth::id();
        // if(Auth::id() !== 1 && $name_of_model !=='absence'){
        //     // abort(403); 
        //     session()->flash('message', "Vous n'avez pas le droit de modifier ces informations.");
        //     return redirect()->back();
        // }
       

        //$user = $model::where('id' ,$id)->get();
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table, $id_of_row);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }
        $data_of_table = $responce_data['content'];

        $data_of_table = $data_of_table[0];
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
      
        // if(!Gate::allows('update',$name_of_model)){
        //     abort(403);
        // }

       
       

        return view('edit', compact(['data_of_table', 'informations_of_columns', 'name_of_model']));
    }

    public function update(DynamicValidation $request, $id_of_row, Post $post)
    {
        // $this->authorize('update', $post);

        $data = (object) $request->validated();

        /*=====================================================================*/
        $name_of_model = $data->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $data->name_of_model . 's';
        /*=====================================================================*/

        $model = 'App\\Models\\'. ucfirst($name_of_model);
        $this->authorize('update', $model);
        
        /*=====================================================================*/
       
        $responce_update = update_data_of_table((array) $data, $name_of_table, $id_of_row);

        if ($responce_update['status'] == 'error') {
            return back()->with('error', $responce_update['content']);
        }
        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/
        return view('index', compact(['data_of_table', 'informations_of_columns', 'name_of_model','post']));
    }

    public function destroy(Request $request, $id_of_row)
    {
        /*=====================================================================*/
        $name_of_model = $request->name_of_model;

        if (empty($name_of_model)) {
            return back()->with('error', 'Name Of Model Is Empty');
        }

        $name_of_table = $request->name_of_model . 's';
       /*=====================================================================*/

       $model = 'App\\Models\\'. ucfirst($name_of_model);
       $this->authorize('destroy', $model);
       
       /*=====================================================================*/

        $responce_delete = delete_data_from_table($name_of_table, $id_of_row);

        if ($responce_delete['status'] == 'error') {
            return back()->with('error', $responce_delete['content']);
        }

        /*=====================================================================*/
        $responce_columns = fetch_columns_of_table($name_of_table);

        if ($responce_columns['status'] == 'error') {
            return back()->with('error', $responce_columns['content']);
        }

        $informations_of_columns = $responce_columns['content'];
        /*=====================================================================*/
        $responce_data = fetch_data_of_table($name_of_table);

        if ($responce_data['status'] == 'error') {

            return back()->with('error', $responce_data['content']);
        }

        $data_of_table = $responce_data['content'];
        /*=====================================================================*/


        return view('index', compact(['data_of_table', 'name_of_model', 'informations_of_columns']));
    }
}
