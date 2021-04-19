<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('guest');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('showmsg');
    }

    public function apiMsg(){

        $response = Http::withToken('8ff5b76d76da5ff4ae38c198c53b7b99')->get('https://mailtrap.io/api/v1/inboxes/1022094/messages');
        return view('showmsg', compact('response'));
    }

    public function viewemail($id){

        $response = Http::withToken('8ff5b76d76da5ff4ae38c198c53b7b99')->get('https://mailtrap.io/api/v1/inboxes/1022094/messages/'.$id.'/body.html');
        return $response;
    }
}
