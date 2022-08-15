<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Stevenmaguire\OAuth2\Client\Provider\Box;
use GuzzleHttp\Client;

class StorageController extends Controller
{
    public function boxredirect(Request $request)
    {
        $box_client_id = config('myconnect.box.clientid');
        $box_redirectURI = config('myconnect.box.redirect_uri');
        Log::debug('ボックス：'.$box_client_id);
        Log::debug('ボックス：'.$box_redirectURI);

        $request->session()->put('state', $state = Str::random(40));
        $query = http_build_query([
        'client_id' => $box_client_id,
        'redirect_uri' => $box_redirectURI,
        'response_type' => 'code',
        'state' => $state,
        ]);
        return redirect('https://account.box.com/api/oauth2/authorize?'.$query);
    }

    public function boxcallback(Request $request)
    {
        $state = $request->session()->pull('state');
        Log::debug(config('myconnect.box.client_secret'));
        $provider = new Box([
            'clientId' => config('myconnect.box.clientid'),
            'clientSecret' => config('myconnect.box.client_secret'),
            'redirectUri' => config('myconnect.box.redirect_uri'),
        ]);
        Log::debug($request->all());
        if (!$request->input('code')) {
            $authUrl = $provider->getAuthorizationUrl();
            Log::debug($authUrl);
            $oauth = Session::put(['oauth2state' => $provider->getState()]);
            Log::debug($oauth);
            header('Location: '.$authUrl);
            exit;
        } elseif (empty($request->input('state')) || ($request->input('state') !== $state)) {
            Session::flush();
            exit('Invalid state');
        } else {
    
            // Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $request->input('code')
            ]);
            Log::debug($token);
        
            // Optional: Now you have a token you can look up a users profile data
            try {
        
                // We got an access token, let's now get the user's details
                $user = $provider->getResourceOwner($token);
                Log::debug($user->getId());
            } catch (Exception $e) {
        
                // Failed to get user details
                exit('Oh dear...');
            }
        
            Session::put(['accesstoken' => $token->getToken()]);

            $client = new Client(['base_uri' => config('myconnect.box.base_uri')]);
            $path = 'folders/0/';
            $options = [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Content-Type' => 'application/json',
                ]
            ];
            $responce = $client->request('GET', $path, $options);
            $responceBody = $responce->getBody()->getContents();
            Log::debug('1回目'.$responceBody);
            $json_responceBody = json_decode($responceBody);

            $responce_data = array(
                'type' => $json_responceBody->type,
                'folder_id' => $json_responceBody->id,
                'item_collection' => $json_responceBody->item_collection->total_count
            );
            
            for ($i=0;$i<$responce_data['item_collection'];$i++) {
                $folders[$i]['folder_id'] = [];
                $folders[$i]['folder_id']=$json_responceBody->item_collection->entries[$i]->id;
                $folders[$i]['folder_name'] = $json_responceBody->item_collection->entries[$i]->name;
            }
            Log::debug($folders);
            
            $count = $responce_data['item_collection'];

            for ($x=0;$x<$count;$x++) {
                $client = new Client(['base_uri' => config('myconnect.box.base_uri')]);
                $path = 'folders/'.$folders[$x]['folder_id'].'/items';
                $options = [
                    'headers' => [
                        'Authorization' => 'Bearer '.$token,
                        'Content-Type' => 'application/json',
                    ]
                ];
                $responce = $client->request('GET', $path, $options);
                $responceBody = $responce->getBody()->getContents();
                
                $json_responceBody = json_decode($responceBody);
                $responce_data = array(
                    'total_count' => $json_responceBody->total_count,
                );
                Log::debug('test'.$responce_data['total_count']);
                if ($responce_data['total_count']<100) {
                    for ($i=0;$i<$responce_data['total_count'];$i++) {
                        $file_id[$i]['type']=$json_responceBody->entries[$i]->type;
                        $file_id[$i]['file_id']=$json_responceBody->entries[$i]->id;
                        /* if(strrchr($json_responceBody->entries[$i]->name,'.')==='.jpeg' || strrchr($json_responceBody->entries[$i]->name,'.')==='.png' || strrchr($json_responceBody->entries[$i]->name,'.')==='.JPG'){ */
                        $file_id[$i]['file_name']=$json_responceBody->entries[$i]->name;
                        /* } */
                    }
                } else {
                    for ($i=0;$i<100;$i++) {
                        $file_id[$i]['type']=$json_responceBody->entries[$i]->type;
                        $file_id[$i]['file_id']=$json_responceBody->entries[$i]->id;
                        $file_id[$i]['file_name']=$json_responceBody->entries[$i]->name;
                    }
                }
                
                $j=0;
                while ($responce_data['total_count']>100) {
                    $j++;
                    $q=$j*100;
                    
                    if ($responce_data['total_count']>100) {
                        $responce_data['total_count'] = $responce_data['total_count']-100;
                        $client = new Client(['base_uri' => config('myconnect.box.base_uri')]);
                        $path = 'folders/'.$folders[$x]['folder_id'].'/items/?offset=100';
                        $options = [
                            'headers' => [
                                'Authorization' => 'Bearer '.$token,
                                'Content-Type' => 'application/json',
                            ]
                        ];
                        $responce = $client->request('GET', $path, $options);
                        $responceBody = $responce->getBody()->getContents();
                        $json_responceBody = json_decode($responceBody);
    
                        for ($i=0;$i<$responce_data['total_count'];$i++) {
                            $file_id[$i]['type']=$json_responceBody->entries[$i]->type;
                            $file_id[$q]['file_id']=$json_responceBody->entries[$i]->id;
                            Log::debug($file_id[$q]['file_id']);
                            $file_id[$q]['file_name']=$json_responceBody->entries[$i]->name;
                            $q++;
                        }
                    }
                }
                $folders[$x]['file']=$file_id;
            }

            /* dd($folders); */

            $statuscode = $responce->getStatusCode();
            if ($statuscode==200) {
                return view('storage')->with([
                    'folders' => json_encode($folders),
                ]);
            } elseif ($statuscode==401) {
                return '認証されていません';
            }
        }
    }
    public function getpreview(Request $request)
    {
        $file_id = request()->file_id;
        Log::debug($file_id);
        $accesstoken=Session::get('accesstoken');
        $user_id = Session::get('user_id');
        Log::info('Box Accesstoken '.$accesstoken);
        if (!$accesstoken) {
            Log::info('アクセストークン取得');
            return redirect('box/redirect');
        }
        $client = new Client(['base_uri' => config('myconnect.box.base_uri')]);
        $path = 'files/'.$file_id.'/content';
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$accesstoken,
                'Content-Type' => 'application/json;charset=UTF-8',
                'Charset' => 'utf-8'
            ]
        ];
        $responce = $client->request('GET', $path, $options);
        $statuscode = $responce->getStatusCode();
        $responceBody = $responce->getBody()->getContents();
        //base64decodeをするとエラーになった
        /* $responceBody = base64_decode($responceBody); */
        $img = imagecreatefromstring($responceBody);
        if ($img !== false) {
            header('Content-Type: image/jpeg');
            imagejpeg($img);
            imagedestroy($img);
        } else {
            echo 'error';
        }

        return $img;
    }
}
