<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;

class NewsCategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component News Category";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $NewsCategory = NewsCategory::get();

            $NewsCategory_list = array("component" => $this->component, "data_component" => $NewsCategory);

            if ($NewsCategory == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($NewsCategory)
                return ResponseFormatterHelper::successResponse($NewsCategory_list, 'Success Get All News Category');
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
            $NewsCategories = [
                'user_id' => Auth::user()->id,
                'news_category_name' => $request->news_category_name,
            ];

		    NewsCategory::create($NewsCategories);

            return ResponseFormatterHelper::successResponse($NewsCategories, 'Create News Category Success');
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
            $NewsCategory = NewsCategory::find($id);

            $NewsCategory_list = array("component" => $this->component, "data_component" => $NewsCategory);

            if ($NewsCategory == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($NewsCategory)
                return ResponseFormatterHelper::successResponse($NewsCategory_list, 'Success Get by ID News Category');
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
            $NewsCategory = NewsCategory::find($id);

            $NewsCategories = [
                'user_id' => Auth::user()->id,
                'news_category_name' => $request->news_category_name,
            ];

            $NewsCategory->update($NewsCategories);

            return ResponseFormatterHelper::successResponse($NewsCategories, 'Update News Category Success');
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
            NewsCategory::destroy($id);

            return ResponseFormatterHelper::successResponse('News Category', 'Delete News Category Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }
}
