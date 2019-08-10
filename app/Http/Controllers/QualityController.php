<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quality;
use Illuminate\Support\Facades\Log;

class QualityController extends Controller
{
    public function store(Request $request)
    {
        Log::info($request->all());
        // Quality::create([])
    }
}
