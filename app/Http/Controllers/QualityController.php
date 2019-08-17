<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quality;
use Illuminate\Support\Facades\Log;

class QualityController extends Controller
{
    public function store(Request $request)
    {
        $gas_values = explode(',',$request->get('payload_fields')['text']);
        
        $inserts = [];
        foreach($gas_values as $gas_value){
            $explodedByColumn = explode(':',$gas_value);
            $key = $explodedByColumn[0];
            $value = floatval($explodedByColumn[1]);
            $inserts[$key] = $value;
        }

        Quality::create($inserts);

        return 'OK';
        
    }

    public function index(Request $request)
    {
        return Quality::paginate(10, ['*'], 'page', $request->get('page'));
    }
}
