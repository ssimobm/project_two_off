<?php

namespace App\Http\Controllers\AdminCp\Admin\Data;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\New_Tvshows;
use App\Models\New_Tvshows_Meta;
use App\Models\Tvshows;
use App\Models\TVMeta;
use App\Models\Categorys;
use App\Models\CategorysMeta;
use App\Models\Options;
use App\Models\User;

use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\MyClass\SimoPhp;
use App\MyClass\MyFunction;
class TVGetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(User $user)
     {
      $this->middleware('auth');
      $this->middleware('admin');
      $this->middleware('siteonline');
      $this->middleware('views')->only('index') ;
      $this->middleware('create')->only('create','store') ;
      $this->middleware('edit')->only('edit','update') ;
      $this->middleware('delete')->only('delete') ;
      //$this->middleware('admin')->only('restore','destroy','showdalet','alldestroy');



          //$this->middleware('admin');
          //$this->middleware('editor');
           //  $this->middleware('throttle:3,1');

     //  $this->middleware('can:Editor_Ep,App\Models\User');
     //MyFunction::authorizes(['Editor_Ep']);
       //MyFunction::permission(['create'], $user);



     }


    public function index() {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      $simoo=New_Tvshows::Paginate(12);

        return view('admincp.Tvshows.index',["data" => $simoo]);

 }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      $Categorys = Categorys::get();

 return view('admincp.Tvshows.Adds1',["Categorys" => $Categorys]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
       {

         MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

         /////////////////////////////
         $DbTvshows = new New_Tvshows;
         $apidata = new SimoPhp;
         $movie = $apidata->PostData($request, "tvshow");
         $slug = Str::slug($request->addTiltle, '-');
         $chek = $DbTvshows->where('slug', $slug)->where('tmdb_id', $request->id_tmdb)->first();
         if (!$chek) {
             $DbTvshows->title = $request->addTiltle;
             $DbTvshows->title_org = $request->Title_tv_org;
             $DbTvshows->type = 'tvshows';
             $DbTvshows->content = $request->editor;
             $DbTvshows->slug  = $slug;
             $DbTvshows->tmdb_id  = $request->id_tmdb;
             $DbTvshows->imdb_id  = $request->id_imdb;
             $DbTvshows->folder_date  = $movie['date_folder'];
             $DbTvshows->timestamps;
             Auth::user()->Usertvshows()->save($DbTvshows);

             // start save info tvshows meta
             foreach ($movie as $key => $value) {
                 $info_movie = new New_Tvshows_Meta;
                 $info_movie->type = 'tvshows';
                 $info_movie->simokey = $key;
                 $info_movie->simovalue =  $value;
                 $info_movie->user_id =  $DbTvshows->user_id;
                 $DbTvshows->tvdata()->save($info_movie);
             }
             // end save info tvshows meta

             $apidata->Categorys($request->category, 'tvshows', $DbTvshows->id);
             $apidata->Tags($request->Tags, 'tvshows', $DbTvshows->id);
         }
         // end check
         $id = $DbTvshows->id ?? $chek->id;
         return redirect('admincp/tvshows/edit/' . $id)->with('status', 'Profile updated!');


       }


    public function edit($Tvshows)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
      $DbTvshows = New_Tvshows::where('id', $Tvshows)->firstOrFail();
      $Tags = $DbTvshows->Tags;
      $Categorys = Categorys::where('taxonomy', 'Categorys')->get();
      $Data = $DbTvshows->tvdata;
      //$test = $Data->where('simokey', 'tvshow_Title')->first();
//dd($test);
      return view('admincp.Tvshows.edit',["tv" => $DbTvshows,"Data" => $Data,"Categorys" => $Categorys]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Tvshows)
    {
      MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

      /////////////////////////////
      $DbTvshows = New_Tvshows::where('id', $Tvshows)->first();
      $apidata = new SimoPhp;
      $movie = $apidata->PostData($request, "tvshow",$DbTvshows);
      $slug = Str::slug($request->addTiltle, '-');

      if ($DbTvshows) {
          $DbTvshows->title = $request->addTiltle;
          $DbTvshows->title_org = $request->Title_tv_org;
          $DbTvshows->type = 'tvshows';
          $DbTvshows->content = $request->editor;
          $DbTvshows->slug  = $slug;
          $DbTvshows->tmdb_id  = $request->id_tmdb;
          $DbTvshows->imdb_id  = $request->id_imdb;
          Auth::user()->UserTvshows()->save($DbTvshows);

          // start save info tvshows meta
          foreach ($movie as $key => $value) {
                $info_movie = New_Tvshows_Meta::where('tv_id', $DbTvshows->id)
                                                ->where('simokey', $key)

                                                ->first();
              if (isset($value)) {
                $info_movie->simovalue =  $value;
                $info_movie->user_id =  $DbTvshows->user_id;
                $DbTvshows->tvdata()->save($info_movie);
              }
          }
          // end save info tvshows meta

          $apidata->Categorys($request->category, 'tvshows', $DbTvshows->id);
          $apidata->Tags($request->Tags, 'tvshows', $DbTvshows);
      }
      // end check
      $id = $DbTvshows->id ;
      return redirect('admincp/tvshows/edit/' . $id)->with('status', 'Profile updated!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delete($tvshow)
     {
       MyFunction::authorizes(['AdmincpSuper', 'Admincp']);

       $user1 = New_Tvshows::Where('id' ,$tvshow)->firstOrFail();

       foreach ($user1->Seasons as $key => $value) {
          foreach ($value->episode as $k => $v) {
            $v->server()->delete();
            $v->delete();
          }
          // $value->episode()->delete();

       }
       $user1->Seasons()->delete();
       $user1->tvdata()->delete();
       $user1->Tags()->delete();
       $user1->delete();
       return back();
     }
     public function restore($tvshow)
     {
       MyFunction::authorizes(['AdmincpSuper','Admincp']);

       $user1 = New_Tvshows::onlyTrashed()->Where('id' ,$tvshow)->firstOrFail();
       foreach ($user1->Seasons as $key => $value) {
          foreach ($value->episode as $k => $v) {
            $v->server()->restore();
          }
           $value->episode()->restore();

       }
       $user1->Seasons()->restore();
       $user1->tvdata()->restore();
       $user1->Tags()->restore();
       $user1->restore();
       return back();
     }
     public function destroy($tvshow)
     {
       MyFunction::authorizes(['AdmincpSuper','Admincp']);

       $user1 = New_Tvshows::onlyTrashed()->Where('id' ,$tvshow)->firstOrFail();
       $user1->forceDelete();
       $user1->tvdata()->forceDelete();
       $user1->Tags()->forceDelete();
       $user1->Seasons()->forceDelete();
       foreach ($user1->Seasons as $key => $value) {
          foreach ($value->episode as $k => $v) {
            $v->forceDelete();
            $v->server()->forceDelete();
          }
           //$value->episode()->forceDelete();

       }
       return back();


     }public function alldestroy()
     {
       MyFunction::authorizes(['AdmincpSuper','Admincp']);

       $user1 = New_Tvshows::onlyTrashed()->get();

       foreach ($user1 as $key => $value) {

         $value->forceDelete();
         $value->Tags()->forceDelete();
         $value->tvdata()->forceDelete();
        // return back();
       }



     }
     public function showdalet()
       {
         MyFunction::authorizes(['AdmincpSuper','Admincp']);

         $user1 = New_Tvshows::onlyTrashed()->simplePaginate(12);
       return view('admincp.Tvshows.Trashed',["data" => $user1]);


       }
}
