<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Session::get('user_id');

        if(!$user_id){
            return redirect('login');
        }

        $i=0;
        $index_word = [];
        $index_words = [];
        $user_id = Session::get('user_id');
        $datas = DB::table('news')->where('user_id', $user_id)->limit(5)->get();
        foreach ($datas as $data) {
            $index_word['id'] = $i;
            $index_word['index_word'] = $data->index_word;
            array_push($index_words,$index_word);
            $index_word = [];
            $i++;
        }
        
        return view('news')->with('index_words',$index_words);
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
        $user_id = Session::get('user_id');
        $newItem = new News;
        $newItem->user_id = $user_id;
        $newItem->index_word = $request->item['name'];
        $newItem->save();
        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function news_list(Request $request)
    {
        Log::debug("news_list API CALL START");
        $index = $request->index_word;
        
        $news_info = [];

        Log::debug("Get news_list from Qiita API CALL START");
        $client = new Client([
            'base_uri' => config("myconnect.qiita.base_uri")
        ]);
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.config("myconnect.qiita.accesstoken"),
            ],
            'query' => [
                'query' => $index,
                'per_page' => 100,
            ]
        ];
        
        $responce = $client->request("GET", 'items', $options);
        $responceBody = $responce->getBody()->getContents();

        $json_responceBody = json_decode($responceBody);
        
        Log::debug("Get news_list from Qiita API CALL END");

        for($i=0;$i<count($json_responceBody);$i++){
            $news_info[$i]['title'] =  $json_responceBody[$i]->title;
            $news_info[$i]['url'] =  $json_responceBody[$i]->url;
        }
        
        Log::debug("news_list API CALL END");
        return json_encode($news_info);
    }

    public function stock_news_list()
    {
        Log::debug("stock_news_list API CALL START");
        $news_info = [];

        Log::debug("Get stock_news_list from Qiita API CALL START");
        $client = new Client([
            'base_uri' => config("myconnect.qiita.base_uri")
        ]);
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.config("myconnect.qiita.accesstoken"),
            ],
            'query' => [
                'per_page' => 100,
            ]
        ];

        $responce = $client->request("GET", 'users/'.config("myconnect.qiita.myaccount").'/stocks', $options);
        $responceBody = $responce->getBody()->getContents();

        $json_responceBody = json_decode($responceBody);
        Log::debug("Get stock_news_list from Qiita API CALL END");

        for($i=0;$i<count($json_responceBody);$i++){
            $news_info[$i]['title'] =  $json_responceBody[$i]->title;
            $news_info[$i]['url'] =  $json_responceBody[$i]->url;
        }
        Log::debug("stock_news_list API CALL END");
        return json_encode($news_info);
    }
}
