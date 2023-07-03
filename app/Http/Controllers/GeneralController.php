<?php

namespace App\Http\Controllers;

use App\Models\Poste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;


class GeneralController extends Controller
{
    public function show_dashboard_page()
    {
        $notifications = auth()->user()->unreadNotifications;
        return view('dashboard', compact('notifications'));
    }

    public function get_all_sources_of_poste(Poste $poste)
    {
        $sources = $poste->sources;
        return response()->json(['sources' => $sources]);
    }

    public function get_absences_in_this_periode(Request $request)
    {
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        return fetch_absence_in_this_period($from_date, $to_date);
    }

    public function get_personnes_with_this_poste(Poste $poste)
    {
        if (Gate::denies('viewAll', Poste::class)) {
            abort(403, 'Unauthorized');
        }
        return fetch_personnes_with_this_poste($poste->id);
    }

    public function stock_id_of_icon($id_icon)
    {
        Cache::forget('extra_informations');

        $data = [
            [
                'data' => $id_icon,
                'column' => 'id_icon'
            ]

        ];

        Cache::forever('extra_informations', $data);
    }
}
