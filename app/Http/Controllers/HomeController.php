<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\User;
use App\Models\News;

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
        $Queues = Queue::where('queue_status', 0)->orderBy('queue_number', 'asc')->get();
        $startQueues = Queue::where('queue_status', 0)->get();
        $progressQueues = Queue::where('queue_status', 1)->get();
        $finishQueues = Queue::where('queue_status', 2)->get();
        $Users = User::get();
        $Newss = News::get();

        return view('home', compact('Queues', 'Users', 'Newss', 'startQueues', 'progressQueues', 'finishQueues'));
    }
}
