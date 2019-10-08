<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Quality;
use Illuminate\Support\Facades\Log;

class QualityController extends Controller {

    private $qualities = [
        'CO',
        'SO2',
        'O3',
        'NO2',
        'PM25',
        'PM10'
    ];

    public function store(Request $request)
    {
        $gas_values = explode(',', $request->get('payload_fields')['text']);

        $inserts = [];
        foreach($gas_values as $gas_value) {
            $explodedByColumn = explode(':', $gas_value);
            $key = $explodedByColumn[0];
            $value = floatval($explodedByColumn[1]);
            $inserts[$key] = $value;
        }

        Quality::create($inserts);

        return 'OK';

    }

    public function index(Request $request)
    {
        return Quality::orderBy('created_at', 'desc')->paginate(10, ['*'], 'page', $request->get('page'));
    }

    public function qualityByDate($date)
    {
        $date = (new Carbon($date))->setTimezone('+3:30');

        $selects = '';

        foreach($this->qualities as $key => $quality) {
            $selects .= ("ROUND(AVG($quality),2) as $quality") . ($key === count($this->qualities) - 1 ? '' : ',');
        }

        return Quality::selectRaw($selects)
                      ->where('created_at', '>', $date->subSeconds(20 * 10))
                      ->first();
    }

    public function qualityLive($qualityName)
    {
        return Quality::where('created_at', '>', Carbon::now()->subMinute(10))
                      ->orderBy('created_at', 'asc')
                      ->get([$qualityName, 'created_at']);
    }

    public function qualityToday($qualityName)
    {
        return Quality::selectRaw("HOUR(created_at) as hour, ROUND(AVG($qualityName),2) as avg")
                      ->where('created_at', '>', Carbon::today())
                      ->orderBy('hour', 'asc')
                      ->groupBy('hour')
                      ->get();
    }

    public function qualityDaysInWeek($qualityName)
    {
        return Quality::selectRaw("DATE(created_at) as day, ROUND(AVG($qualityName),2) as avg")
                      ->where('created_at', '>', Carbon::today()->subDay(6))
                      ->orderBy('day', 'asc')
                      ->groupBy('day')
                      ->get();
    }

    public function qualityDaysInMonth($qualityName)
    {
        return Quality::selectRaw("DATE(created_at) as day, ROUND(AVG($qualityName),2) as avg")
                      ->where('created_at', '>', Carbon::today()->subMonth(1))
                      ->orderBy('day', 'asc')
                      ->groupBy('day')
                      ->get();
    }

    public function qualityMonth($qualityName)
    {
        return Quality::selectRaw("MONTH(created_at) as month, ROUND(AVG($qualityName),2) as avg")
                      ->where('created_at', '>', Carbon::today()->subYear(1))
                      ->orderBy('month', 'asc')
                      ->groupBy('month')
                      ->get();
    }
}
