<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopicModel;

class TopicController extends Controller
{

   public function publish($topic ,Request $request)
   {

              $data = array(
               'topic' => $topic,
               'response' => 'success',
               'response_code' => 0,
               'data' => $request->all()
             );
           return response()->json($data);
  }

  public function subscribe($topic, Request $request)
  {
        TopicModel::create([
          'topic' => $topic
        ]);

        $data = array(
             'url' => $request->url,
             'topic' => $topic
        );
        return response()->json($data);
  }


}
