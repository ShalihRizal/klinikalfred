<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component Doctor";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $Doctor = Doctor::get();

            foreach ($Doctor as $value) {
                $DoctorList[] = [
                    'doctor_name' => $value->doctor_name,
                    'doctor_image' => $this->url.'/app/public/'.$value->doctor_image,
                    'doctor_speciality' => $value->doctor_speciality,
                ];
            }

            $doctor_list = array("component" => $this->component, "data_component" => $DoctorList);

            if ($Doctor == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($Doctor)
                return ResponseFormatterHelper::successResponse($doctor_list, 'Success Get All Doctor');
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

            return ResponseFormatterHelper::successResponse($Doctor, 'Create Doctor Success');
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
            $Doctor = Doctor::find($id);

            $DoctorList;
            if ($Doctor) {
                $DoctorList = [
                    'doctor_name' => $Doctor->doctor_name,
                    'doctor_image' => $this->url.'/app/public/'.$Doctor->doctor_image,
                    'doctor_speciality' => $Doctor->doctor_speciality,
                ];
            }

            $doctor_list = array("component" => $this->component, "data_component" => $DoctorList);

            if ($Doctor == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($Doctor)
                return ResponseFormatterHelper::successResponse($doctor_list, 'Success Get by ID Doctor');
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
            $Doctor = Doctor::find($id);
            if ($request->doctor_image <> "") {
                Storage::delete('public/' . $filePath . $Doctor->doctor_image);

                $file = $request->doctor_image;
                $fileName_doctor = DataHelper::getFileName($file);
                $filePath = DataHelper::getFilePath(false, true);
                $request->file('doctor_image')->storeAs($filePath, $fileName_doctor, 'public');

                $Doctor = [
                    'doctor_name' => $request->doctor_name,
                    'doctor_image' => $fileName_doctor,
                    'doctor_speciality' => $request->doctor_speciality,
                ];
            }else{
                $Doctor = [
                    'doctor_name' => $request->doctor_name,
                    'doctor_speciality' => $request->doctor_speciality,
                ];
            }

            $Doctor->update($Doctor);

            return ResponseFormatterHelper::successResponse($Doctor, 'Update Doctor Success');
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
            $Doctor = Doctor::find($id);

            $filePath = DataHelper::getFilePath(false, true);
            Storage::delete('public/' . $filePath . $Doctor->doctor_image);

            Doctor::destroy($id);

            return ResponseFormatterHelper::successResponse('Doctor', 'Delete Doctor Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }
}
