<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nsstops as nsstops;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DowntimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
         $downtimes = nsstops::orderBy('created_at','desc')->get();
        return view('downtime.downtime',compact('downtimes'));
    }


}
