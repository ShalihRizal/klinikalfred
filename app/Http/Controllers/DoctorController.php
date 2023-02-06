<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Helpers\DataHelper;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component Doctor";
        $this->url = "https://klinikdralfred.nocturnailed.tech/";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Doctor = Doctor::get();
        $url = $this->url;
        return view('doctor.index', compact('Doctor', 'url'));
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
        $file = $request->doctor_image;
        $fileName_doctor = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('doctor_image')->storeAs($filePath, $fileName_doctor, 'public');

        $Doctor = [
            'doctor_name' => $request->doctor_name,
            'doctor_image' => $fileName_doctor,
            'doctor_speciality' => $request->doctor_speciality,
        ];

        Doctor::create($Doctor);

        return redirect('doctor');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $News = News::find($id);
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
        $Doctor = Doctor::find($id);

        if ($request->doctor_image <> "") {
            Storage::delete('public/' . $filePath . $Doctor->doctor_image);

            $file = $request->doctor_image;
            $fileName_doctor = DataHelper::getFileName($file);
            $filePath = DataHelper::getFilePath(false, true);
            $request->file('doctor_image')->storeAs($filePath, $fileName_doctor, 'public');

            $Doctorv = [
                'doctor_name' => $request->doctor_name,
                'doctor_image' => $fileName_doctor,
                'doctor_speciality' => $request->doctor_speciality,
            ];
        }else{
            $Doctorv = [
                'doctor_name' => $request->doctor_name,
                'doctor_speciality' => $request->doctor_speciality,
            ];
        }

        $Doctor->update($Doctorv);

        return redirect('doctor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Doctor = Doctor::find($id);

        $filePath = DataHelper::getFilePath(false, true);
        Storage::delete('public/' . $filePath . $Doctor->doctor_image);

        Doctor::destroy($id);

        return redirect('doctor');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = Doctor::find($id);

        if ($getDetail)
            return ResponseFormatterHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return ResponseFormatterHelper::_errorResponse(null, 'Data tidak ditemukan');
    }
}
