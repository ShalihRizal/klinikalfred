<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Http\Request;
use App\Models\Queue;
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
        try {
            $Queue = Queue::where('queue_status', 0)->orderBy('queue_number', 'asc')->get();

            $Queue_list = array("component" => $this->component, "data_component" => $Queue);

            if ($Queue == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($Queue)
                return ResponseFormatterHelper::successResponse($Queue_list, 'Success Get All Queue');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
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
        try {
            $Queue = [
                'user_id' => $request->user_id,
                'queue_number' => $request->queue_number,
                'priority_number' => $request->priority_number,
                'queue_status' => $request->queue_status,
            ];

		    Queue::create($Queue);

            return ResponseFormatterHelper::successResponse($Queue, 'Create Queue Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $Queue = Queue::find($id);

            $Queue_list = array("component" => $this->component, "data_component" => $Queue);

            if ($Queue == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($Queue)
                return ResponseFormatterHelper::successResponse($Queue_list, 'Success Get by ID Queue');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showByUser($user_id)
    {
        try {
            $Queue = Queue::where('user_id', $user_id)->get();

            $Queue_list = array("component" => $this->component, "data_component" => $Queue);

            if ($Queue == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($Queue)
                return ResponseFormatterHelper::successResponse($Queue_list, 'Success Get by ID Queue');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
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
        try {
            $Queue = Queue::find($id);

            $Queues = [
                'user_id' => $request->user_id,
                'queue_number' => $request->queue_number,
                'priority_number' => $request->priority_number,
                'queue_status' => $request->queue_status,
            ];

            $Queue->update($Queues);

            return ResponseFormatterHelper::successResponse($Queues, 'Update Queues Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Queue::destroy($id);

            return ResponseFormatterHelper::successResponse('Queues', 'Delete Queues Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }
}
