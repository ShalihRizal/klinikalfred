<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component News";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $News = News::leftJoin('news_categories', 'news.news_category_id', '=', 'news_categories.id')->get();

            $News_list = array("component" => $this->component, "data_component" => $News);

            if ($News == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($News)
                return ResponseFormatterHelper::successResponse($News_list, 'Success Get All News');
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
            $News = [
                'user_id' => $request->user_id,
                'news_category_id' => $request->news_category_id,
                'news_title' => $request->news_title,
                'news_image' => $request->news_image,
                'news_description' => $request->news_description,
            ];

		    News::create($News);

            return ResponseFormatterHelper::successResponse($News, 'Create News Success');
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
            $News = News::leftJoin('news_categories', 'news.news_category_id', '=', 'news_categories.id')->find($id);

            $News_list = array("component" => $this->component, "data_component" => $News);

            if ($News == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($News)
                return ResponseFormatterHelper::successResponse($News_list, 'Success Get by ID News');
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
            $News = News::find($id);

            $News = [
                'user_id' => $request->user_id,
                'news_category_id' => $request->news_category_id,
                'news_title' => $request->news_title,
                'news_image' => $request->news_image,
                'news_description' => $request->news_description,
            ];

            $News->update($News);

            return ResponseFormatterHelper::successResponse($News, 'Update News Success');
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
            News::destroy($id);

            return ResponseFormatterHelper::successResponse('News', 'Delete News Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }
}
