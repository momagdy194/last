<?php

namespace App\Http\Controllers;

use App\Models\state;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $states = state::with(['country'])->paginate(env('PAGINATION_COUNT'));
        return view('admin.states.states')->with([
                'states' => $states
        ]);
    }
}
