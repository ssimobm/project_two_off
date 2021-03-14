<?php

namespace App\Http\Controllers\AdminCp\Admin\Settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\User;
use App\Models\Movies;
use Auth;

use App\Models\Comments;
class LikesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //$Movies= Movies::find('1') ;
      //$likes = count($Movies->Like->where('type', 'movies')->where('liks', '1')->all());




      $comments = Movies::find('1')->comment()->orderBy('created_at', 'desc')->where('parent_id', '0')->simplePaginate(10);

      foreach ($comments as $key => $value) {
        $comm = $value->where('id', $value->id)->first()->comment->sortByDesc('created_at');
        $comm1 = $value->where('id', $value->id)->where('parent_id', "0")->first();
        $simoo = $value->where('id', $value->id)->first()->user->name;
       $ids = $simoo = $value->where('id', $value->id)->first()->user->id;
       $likes = $value->where('id', $value->id)->first()->Like->all() ;
        $likesimo = $value->where('id', $value->id)->first()->Like->where('user_id', Auth::user()->id)->first() ;

 echo count($likes)." done <br>";
       foreach ($likes as $k1 => $v1) {

         if ($v1->user_id == "31") {
            echo "very id :".$v1->type_id." => user :".$v1->user_id." => commnet: ".$v1->liks." done <br>";
         }else {
          echo "vide<br>";
         }
       }

      }
      dd($likesimo);
echo Auth::user()->id;
      dd($likes);
      $Moviess= Movies::find('1')->comment->where('type', 'movies')->where('user_id', '30')->where('parent_id', '0')->all() ;
      //$like = $Movies->Like->where('type', 'Comments')->where('user_id', '30')->first();
      foreach ($Moviess as $key => $value) {
        $simo = $value->Like->all() ;
        foreach ($simo as $k => $v) {
          echo "id :".$v->type_id." => user :".$v->user_id." => commnet: ".$v->liks."<br>";
        }

      }






      $Movies= Comments::find('190') ;
      $likes = count($Movies->Like->where('type', 'Comments')->where('liks', '1')->all());

      $like = $Movies->Like
          ->where('user_id', Auth::user()->id)
          ->first();


        return view('admincp.Likes.Like',['like' => $like , 'likes' => $likes ]);
    }


    public function store(Request $request,$id)
    {
      //$Movies= Movies::find('1') ;
      //$like = $Movies->Like->where('type', 'movies')->where('user_id', '30')->first();



if (isset(Auth::user()->id)) {
  $Movies= Comments::find($request->idsimo) ;
        $like = $Movies->Like->where('liks_type', 'likes')->where('user_id', Auth::user()->id)->first();
  if (isset($like)) {
   $like->forceDelete();
   }else {
    $Db = new Likes ;
    $Db->type = "Comments" ;
    $Db->parent_id = '0' ;
    $Db->user_id = Auth::user()->id ;
    if ('like' === 'like') {
    $Db->liks = '1' ;
  }else {
    $Db->liks = '0' ;
  }
    $Db->liks_type = 'likes' ;
    $Db->timestamps ;
    $Movies->Like()->save($Db);

  }

}
$likes = count(Comments::find($request->idsimo)->Like->where('liks_type', 'likes')->where('liks', '1')->all());

return $likes;

            if (!isset(Auth::user()->id) AND 'like' === $request->like) {
              return view('admincp.auth.ajaxlogin') ;
            }



    }
}
