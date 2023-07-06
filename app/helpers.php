<?php

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;


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

#Each Model can contain small difference from another Model
#So this function is made to handle those diferences
function addition_functions($name_of_table, $data = null)
{
    if ($name_of_table == 'personnes' && isset($data[0]->date_notification)) {
        $data = [
            'id_personne' => $data[1],
            'comment' => 'Le Stage touche à son fin',
            'date' => $data[0]->date_notification
        ];
        Event::create($data);
    }

    if ($name_of_table == 'bans') {

        try {
            DB::table('personnes')->where('cin', $data[0]->cin)->delete();
        } catch (QueryException $e) {
            abort(403, "An error occurred while deleting the record.");
        }
    }
}
