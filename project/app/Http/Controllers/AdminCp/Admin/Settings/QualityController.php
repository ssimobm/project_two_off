<?php

namespace App\Http\Controllers\AdminCp\Admin\Settings;
use App\Http\Controllers\Controller;

use App\MyClass\MyFunction;
use App\Models\Categorys;
use App\Models\Movies;
use App\Models\Tvshows;
use App\Models\Episodes;
use App\Models\Comments;
use App\Models\TVMeta;
use App\Models\Options;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class QualityController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('admin');
    }

    public function index_tag($tv ,$tags, $slug)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);

       $simo[] = "null" ;
        $Categorys = Categorys::where('slug', $slug)->firstOrFail();
        foreach ($Categorys->cate_meta->where('taxonomy', ucfirst($tags)) as $key => $value) {
          $simo1 = Movies::where('type', ucfirst($tv))->where('id', $value->type_id)->first();

          if (isset($simo1->id)) {
            $simo[] = $simo1;

          }else {

          }

        }

        return view('admincp.quality.index_tags',[ "Quality"=>$simo ,]);
    }


    public function index()
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);

        $Categorys = Categorys::where('type', 'Quality')->simplePaginate(12);

        return view('admincp.quality.index',[ "Quality"=>$Categorys ,]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);

        return view('admincp.quality.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);



        $slug = Str::slug($request->addTiltle , "-");
        $Categorys = Categorys::where('type', 'Quality')->where('slug', $slug)->first() ;


        if (!isset($Categorys)) {
          $Categorys = new Categorys;
          $Categorys->name = $request->addTiltle;
          $Categorys->slug = $slug;
          $Categorys->type = "Quality";
          $Categorys->taxonomy = "Quality";
          $Categorys->parent_id = '0';
          $Categorys->save();
        }
        return redirect('/admincp/quality/edit/'.$Categorys->id)->with('status', 'Profile updated!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorys  $categorys
     * @return \Illuminate\Http\Response
     */
    public function show(Categorys $categorys)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorys  $categorys
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorys $categorys , $id)
    {

      MyFunction::authorizes(['AdmincpSuper','Admincp']);

      $quality = Categorys::where('type', 'Quality')->where('id', $id)->first() ;
      return view('admincp.quality.edit',['quality'=>$quality,]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorys  $categorys
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorys $categorys , $id)
    {

      MyFunction::authorizes(['AdmincpSuper','Admincp']);


      $Categorys = Categorys::where('type', 'Quality')->find($id) ;
      if (isset($Categorys)) {
        $Categorys->name = $request->addTiltle;
        $Categorys->save();
      }
         return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorys  $categorys
     * @return \Illuminate\Http\Response
     */
     public function delete($id)
     {

       MyFunction::authorizes(['AdmincpSuper','Admincp']);

       $user1 = Categorys::Where('id' ,$id)->firstOrFail();
       $user1->cate_meta()->where('taxonomy', 'Quality')->delete();
       $user1->delete();

       return back();
     }
     public function restore($id)
     {

       MyFunction::authorizes(['AdmincpSuper','Admincp']);

       $user1 = Categorys::onlyTrashed()->Where('id' ,$id)->firstOrFail();
       //$user1->server()->where('type', 'Episode')->restore();
       $user1->restore();
       return back();
     }
     public function destroy($id)
     {
       MyFunction::authorizes(['AdmincpSuper','Admincp']);


       $user1 = Categorys::onlyTrashed()->Where('id' ,$id)->firstOrFail();

       $user1->forceDelete();
       $user1->cate_meta()->where('taxonomy', 'Quality')->forceDelete();
       return back();


     }
     public function showdalet()
       {

         MyFunction::authorizes(['AdmincpSuper','Admincp']);

         $user1 = Categorys::onlyTrashed()->simplePaginate(12);
       return view('admincp.quality.Trashed',["Quality" => $user1]);


       }

}
