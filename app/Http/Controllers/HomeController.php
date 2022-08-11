<?php

namespace App\Http\Controllers;
use App\Events\TestEvent;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }

    public function test(){
        #Metodo que se usa de prueba que recibe del front y manda este evento en tiempo real
        event(new TestEvent("Esta llegando del frontend"));
    }
}
