<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Helpers\ResponseFormatterHelper;
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
        $NewsCategories = NewsCategory::get();
        $Users = User::get();

        return view('news_category.index', compact('NewsCategories', 'Users'));
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
        $NewsCategory = [
            'user_id' => Auth::user()->id,
            'news_category_name' => $request->news_category_name,
        ];

        NewsCategory::create($NewsCategory);

        return redirect('news-category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $NewsCategory = NewsCategory::find($id);
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
        $NewsCategory = NewsCategory::find($id);

            $NewsCategories = [
                'user_id' => Auth::user()->id,
                'news_category_name' => $request->news_category_name,
            ];

            $NewsCategory->update($NewsCategories);

            return redirect('news-category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NewsCategory::destroy($id);

        return redirect('news-category');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = NewsCategory::find($id);

        if ($getDetail)
            return ResponseFormatterHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return ResponseFormatterHelper::_errorResponse(null, 'Data tidak ditemukan');
    }
}
