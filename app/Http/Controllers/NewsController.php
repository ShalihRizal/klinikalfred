<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\User;
use App\Helpers\ResponseFormatterHelper;
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
        $NewsCategories = NewsCategory::get();
        $News = News::get();
        $Users = User::get();

        return view('news.index', compact('NewsCategories', 'News', 'Users'));
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
        $News = [
            'user_id' => Auth::user()->id,
            'news_category_id' => $request->news_category_id,
            'news_title' => $request->news_title,
            'news_image' => $request->news_image,
            'news_description' => $request->news_description,
        ];

        News::create($News);

        return redirect('news');
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
        $News = News::find($id);

            $Newsv = [
                'user_id' => Auth::user()->id,
                'news_category_id' => $request->news_category_id,
                'news_title' => $request->news_title,
                'news_image' => $request->news_image,
                'news_description' => $request->news_description,
            ];

            $News->update($Newsv);

            return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);

        return redirect('news');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = News::find($id);

        if ($getDetail)
            return ResponseFormatterHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return ResponseFormatterHelper::_errorResponse(null, 'Data tidak ditemukan');
    }
}
