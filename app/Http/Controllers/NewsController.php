<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news_info = [];
        $client = new Client([
            'base_uri' => config("myconnect.qiita.base_uri")
        ]);
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.config("myconnect.qiita.accesstoken"),
            ],
            'query' => [
                'query' => 'mongoDB',
                'per_page' => 100,
            ]
        ];
        
        $responce = $client->request("GET", 'items', $options);
        $responceBody = $responce->getBody()->getContents();

        $json_responceBody = json_decode($responceBody);
        
        for($i=0;$i<count($json_responceBody);$i++){
            $news_info[$i]['title'] =  $json_responceBody[$i]->title;
            $news_info[$i]['url'] =  $json_responceBody[$i]->url;
        }
        
        return json_encode($news_info);
        
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
        //
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
}
