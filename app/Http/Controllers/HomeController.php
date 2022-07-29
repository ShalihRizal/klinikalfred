<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Queues = Queue::get();
        $startQueues = Queue::where('queue_status', 0)->get();
        $finishQueues = Queue::where('queue_status', 1)->get();
        $Users = User::get();

        return view('home', compact('Queues', 'Users', 'startQueues', 'finishQueues'));
    }
}
