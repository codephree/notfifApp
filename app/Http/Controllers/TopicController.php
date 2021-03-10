<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopicModel;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{

   public function publish($topic ,Request $request)
   {

           $top = TopicModel::where('topic',$topic)->get();
           $count = 0;
           $list = array();
           foreach ($top as $key)
           {
                // $subs = $this->callSubscriberEndpoint($key['url'], $request->all());
                 if ($this->callSubscriberEndpoint($key['url'], $request->all()))
                {
                   $count++;
                   $list['endpoint_'.$count] = $key['url'];
                }
           }
           $data = [
                 'topic' => $topic,
                  'data' => [
                      'endpoint_processed_no' => $count,
                      'list_of_process_endpoints' => $list,
                      'user_input' => $request->all()
                  ]
             ];
           return response()->json($data);
  }

  public function subscribe($topic, Request $request)
  {

        $data = [];  //Return data to the client
        $validator = Validator::make($request->all(), ['url' => 'required|unique:topic_models|url']);
        /*
        *  If validation failed
        */
        if($validator->fails())
        {

           $data = [
             'response' => 1,
             'message' => $validator->messages()->first()
           ];

        } else {
            $data = array(
                 'url' => $request->url,
                 'topic' => $topic
            );

            TopicModel::create($data);
        }

       return response()->json($data);
  }
  /*
  *  Call all subscriber endpoint to recieve messages
  */
  private function callSubscriberEndpoint($url, $data)
  {
        $client = new Client(); //GuzzleHttp\Client
        try {
            $result = $client->post($url, [
              'form_params' => $data
            ]);
            $response =  json_decode($result->getBody(), true);
            if($response['status'] != 0)
            {
              return false;
            }

            return true;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {

            return false;

        }


  }




}
