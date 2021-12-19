<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Likes;
use Illuminate\Http\Request;
use App\Photo;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Throwable;

class PhotoAlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $user_id = Session::get('user_id');
        Log::debug($user_id, ['file' => __FILE__, 'line' => __LINE__]);
        $photos = Photo::where('state','1')
        ->where('user_id', $user_id)->get();
        Log::debug($photos);
        return $photos->toJson();
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
        /* dd(request()->all()); */
        $user_id = Session::get('user_id');
        Log::debug($user_id, ['file' => __FILE__, 'line' => __LINE__]);
        $file_name = request()->file->getClientOriginalName();
        Log::debug($file_name);
        request()->file->storeAs('public/photo',$file_name);
        
        $image = new Photo();
        $image->user_id = $user_id;
        Log::debug($image->user_id);
        $image->state = 1;
        Log::debug($image->state);
        $image->path = 'storage/photo/' . $file_name;
        $image->filename = $file_name;
        $image->save();
        return ['success' => '登録しました!'];

    }

    public function boxindex()
    {
        $accesstoken=Session::get('accesstoken');
        Log::info('Box Accesstoken '.$accesstoken);
        if(!$accesstoken){
            Log::info('アクセストークン取得なし');
            return '認証されていません';
        }
        $client = new Client(['base_uri' => 'https://api.box.com/2.0/folders/']);
        $path = '0/';
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$accesstoken,
                'Content-Type' => 'application/json',
            ]
        ];
        $responce = $client->request('GET',$path,$options);
        $responceBody = $responce->getBody()->getContents();
        Log::debug($responceBody);
        $json_responceBody = json_decode($responceBody);

        $responce_data = array(
            'type' => $json_responceBody->type,
            'folder_id' => $json_responceBody->id,
            'item_collection' => $json_responceBody->item_collection->total_count
        );

        for($i=0;$i<$responce_data['item_collection'];$i++){
            $folder[] = $json_responceBody->item_collection->entries[$i]->id;
            $folder_name[] = $json_responceBody->item_collection->entries[$i]->name;
        }
        Log::debug($folder);
        Log::debug($folder_name);
        Log::debug($responce_data);

        $statuscode = $responce->getStatusCode();
        if($statuscode==200){
            return json_encode($folder);
        }elseif($statuscode==401){
            return '認証されていません';
        }

    }

    public function storefrombox()
    {
        $accesstoken=Session::get('accesstoken');
        $user_id = Session::get('user_id');
        Log::info('Box Accesstoken '.$accesstoken);
        if(!$accesstoken){
            Log::info('アクセストークン取得');
            return redirect('box/redirect');
        }
        $client = new Client(['base_uri' => 'https://api.box.com/2.0/files/']);
        $path = '711135700207/content';
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$accesstoken,
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ]
        ];
        $responce = $client->request('GET',$path,$options);
        $statuscode = $responce->getStatusCode();
        $responceBody = $responce->getBody()->getContents();
        //base64decodeをするとエラーになった
        /* $responceBody = base64_decode($responceBody); */
        $img = imagecreatefromstring($responceBody);
        $file_name = 'test3.jpeg';
        $storagepath = 'storage/photo/';
        if($img !== false){
            header('Content-Type: image/jpeg');
            imagejpeg($img,$storagepath.$file_name);
            imagedestroy($img);
        }else{
            echo 'error';
        }

        $image = new Photo();
        $image->user_id = $user_id;
        Log::debug($image->user_id);
        $image->state = 1;
        Log::debug($image->state);
        $image->path = 'storage/photo/' . $file_name;
        $image->filename = $file_name;
        $image->save();

        return ['success' => '登録しました!'];
        /* return $responceBody; */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ok = 'true';
        $ng = 'false';

        $favorite = DB::table('likes')->where('photo_id','=',$id)->first();
        if($favorite){
            Log::debug('対象あり');
            Log::info(json_encode($favorite));
            return $ok;
        }else{
            Log::debug('対象なし');
            return $ng;
        }
    }

    public function title_show($id)
    {
        $ng = 'false';

        $query1 = DB::table('comments')->where('photo_id','=',$id)->first();
        if($query1){
            Log::debug('対象あり');
            Log::info(json_encode($query1));
            return json_encode($query1);
        }else{
            Log::debug('対象なし');
            return $ng;
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
/*             $update_photo_title = new Comments;
            $title = $request->input('title');
            Log::debug($title);
            $query1 = DB::table('comments')->where('photo_id','=',$id)->first();
            Log::info(json_encode($query1));
            if(!$query1){
                $update_photo_title->photo_id = $id;
                $update_photo_title->title = $title;
                $update_photo_title->user_id = 1;
            }else{
                Log::info('何もしないでよし！');
                return ['success' => '何もしないでよし!'];
            }
            $update_photo_title->save(); */

            $update_photo = new Likes;
            $favorite = $request->input('favorite');
            Log::debug($favorite);
            $query = DB::table('likes')->where('photo_id','=',$id)->first();
            Log::info(json_encode($query));

            if($favorite == 'true'){
                if(!$query){
                    $update_photo->photo_id = $id;
                    $update_photo->user_id = 1;
                }else{
                    return ['success' => '既にデータがあります!'];
                }
            }else{
                if(!$query){
                    Log::info('何もしないでよし！');
                    return ['success' => '何もしないでよし!'];
                }
                DB::table('likes')->where('photo_id','=',$id)->delete();
                Log::info('レコード削除しました！');
                return ['success' => 'レコード削除しました!'];
            }
            $update_photo->save();
            return ['success' => '登録しました!'];
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
