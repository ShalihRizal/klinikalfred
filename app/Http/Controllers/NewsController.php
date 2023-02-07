<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use App\Models\News;
use App\Models\User;
use App\Helpers\DataHelper;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component News";
        $this->url = "https://klinikdralfred.nocturnailed.tech/";
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
        $url = $this->url;
        return view('news.index', compact('NewsCategories', 'News', 'Users', 'url'));
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
        $file = $request->news_image;
        $fileName_news = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('news_image')->storeAs($filePath, $fileName_news, 'public');

        $News = [
            'user_id' => Auth::user()->id,
            'news_category_id' => $request->news_category_id,
            'news_title' => $request->news_title,
            'news_image' => $filePath.$fileName_news,
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

        if ($request->news_image <> "") {
            if ($News->news_image <> "") {
                unlink(public_path('app/public').'/'.$News->news_image);
            }

            $file = $request->news_image;
            $fileName_news = DataHelper::getFileName($file);
            $filePath = DataHelper::getFilePath(false, true);
            $request->file('news_image')->storeAs($filePath, $fileName_news, 'public');

            $Newsv = [
                'user_id' => Auth::user()->id,
                'news_category_id' => $request->news_category_id,
                'news_title' => $request->news_title,
                'news_image' => $filePath.$fileName_news,
                'news_description' => $request->news_description,
            ];
        }else{
            $Newsv = [
                'user_id' => Auth::user()->id,
                'news_category_id' => $request->news_category_id,
                'news_title' => $request->news_title,
                'news_description' => $request->news_description,
            ];
        }

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
        $News = News::find($id);

        if ($News->news_image <> "") {
            unlink(public_path('app/public').'/'.$News->news_image);
        }

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
