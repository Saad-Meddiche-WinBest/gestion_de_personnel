<?php

use Carbon\Carbon;

function color_expired_event($name_of_model, $column, $data)
{
    if ($name_of_model == 'event' && $column['name'] == 'date' && $data->{$column['name']} == Carbon::today()->format('Y-m-d')) {
        echo 'style="background-color: grey"';
    }
}
