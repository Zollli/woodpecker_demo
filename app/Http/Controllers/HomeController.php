<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index(){

    $json_path = Storage::disk('data')->get('data.json');
    $config_decoded = json_decode($json_path, true);
    dd($config_decoded);

    return view('main.index');
  }

}
