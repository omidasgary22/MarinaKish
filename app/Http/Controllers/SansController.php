<?php

namespace App\Http\Controllers;

use App\Models\Sans;
use Illuminate\Http\Request;

class SansController extends Controller
{
    static function store($time, $pending, $total, $start_time, $ended_at, $id)
    {
        while ($start_time->lessThan($ended_at)) {
            Sans::create([
                'product_id' => $id,
                'start_time' => $start_time->toTimeString(),
                'capacity' => $total,
            ]);
            $start_time->addMinute($pending + $time);
        }
    }
}
