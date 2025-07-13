<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class User extends Controller
{
    function tarif(){
        $tarif = DB::connection()->table('tarifs')->get();
        return $tarif;
    }
}
