<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queue;
use App\Models\User;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Support\Facades\Auth;

class QueueController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component Queue";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Queues = Queue::orderBy('queue_number', 'asc')->get();
        $Users = User::get();

        return view('queue.index', compact('Queues', 'Users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Queue = [
            'user_id' => $request->user_id,
            'queue_number' => $request->queue_number,
            'priority_number' => $request->priority_number,
            'queue_status' => $request->queue_status,
        ];

        Queue::create($Queue);

        return redirect('queue');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Queue = Queue::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Queue = Queue::find($id);

            $Queues = [
                'user_id' => $request->user_id,
                'queue_number' => $request->queue_number,
                'priority_number' => $request->priority_number,
                'queue_status' => $request->queue_status,
            ];

            $Queue->update($Queues);

            return redirect('queue');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_user(Request $request, $id)
    {
        $Queue = Queue::find($id);

            $Queues = [
                'user_id' => $request->user_id,
                'queue_number' => $request->queue_number,
                'priority_number' => $request->priority_number,
                'queue_status' => $request->queue_status,
            ];

            $Queue->update($Queues);

            return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Queue::destroy($id);

        return redirect('queue');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = Queue::find($id);

        if ($getDetail)
            return ResponseFormatterHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return ResponseFormatterHelper::_errorResponse(null, 'Data tidak ditemukan');
    }
}
