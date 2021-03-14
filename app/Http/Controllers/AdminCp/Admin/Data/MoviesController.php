<?php

namespace App\Http\Controllers\AdminCp\Admin\Data;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\New_Movies;
use App\Models\New_Movies_Meta;
use App\Models\Movies;
use App\Models\TVMeta;
use App\Models\Servers;
use App\Models\Categorys;
use App\Models\CategorysMeta;
use App\Models\Options;
use App\MyClass\MyClass2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\MyClass\SimoPhp;
use App\MyClass\MyFunction;
class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('siteonline');
        $this->middleware('views')->only('index');
        $this->middleware('create')->only('create', 'store');
        $this->middleware('edit')->only('edit', 'update');
        $this->middleware('delete')->only('delete');
        //$this->middleware('admin')->only('restore', 'destroy', 'showdalet', 'alldestroy');

    }

    public function indexajax(Request $request, $id)
    {
          MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        if (isset($request)) {
            // code...
            $Movies = New_Movies::get();
            if (isset($Movies)) {
                // code...

                $Options = new MyClass2;
                $Options->DB = 'App\Models\Options';
                $Options->Value = 'option_value';


                if ($Options->Simo_Op('option_name', 'tmdb_api') == true) {
                    $link = "https://api.themoviedb.org/3/movie/popular";
                    $linkpatch = $link . "?api_key=" . $Options->Simo_Op('option_name', 'tmdb_api') . "&language=" . $Options->Simo_Op('option_name', 'tmdb_lang') . "&page=" . $id;

                    $daata1 = json_decode(file_get_contents($linkpatch))->results;
                    return view('admincp.apidata.Movies.m_ajax', ['data' => $daata1, 'movies' => $Movies,]);
                }
            }
        }
        if (!isset($request)) {
            return redirect()->guest('data/movies');
        } {
        }
    }
    public function index()
    {
          MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $simoo = New_Movies::Paginate(12);
        return view('admincp.Movies.index', ["data" => $simoo]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {     MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $Categorys = Categorys::get();
        return view('admincp.Movies.Adds1', ["Categorys" => $Categorys]);
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
        $DbMovies = new New_Movies;
        $apidata = new SimoPhp;
        $movie = $apidata->PostData($request, "movie");
        $slug = Str::slug($request->addTiltle, '-');
        $chek = $DbMovies->where('slug', $slug)->where('tmdb_id', $request->id_tmdb)->first();
        if (!$chek) {
            $DbMovies->title = $request->addTiltle;
            $DbMovies->title_org = $request->Title_tv_org;
            $DbMovies->type = 'movies';
            $DbMovies->content = $request->editor;
            $DbMovies->slug  = $slug;
            $DbMovies->tmdb_id  = $request->id_tmdb;
            $DbMovies->imdb_id  = $request->id_imdb;
            $DbMovies->folder_date  = $movie['date_folder'];
            $DbMovies->timestamps;
            Auth::user()->UserMovies()->save($DbMovies);

            // start save info movies meta
            foreach ($movie as $key => $value) {
                $info_movie = new New_Movies_Meta;
                $info_movie->type = 'movies';
                $info_movie->simokey = $key;
                $info_movie->simovalue =  $value;
                $info_movie->user_id =  $DbMovies->user_id;
                $DbMovies->tvdata()->save($info_movie);
            }
            // end save info movies meta

            $apidata->Categorys($request->category, 'movies', $DbMovies->id);
            $apidata->Categorys($request->quality, 'movies', $DbMovies->id,"Quality");
            $apidata->Tags($request->Tags, 'movies', $DbMovies->id);
        }
        // end check
        $id = $DbMovies->id ?? $chek->id;
        return redirect('admincp/movies/edit/' . $id)->with('status', 'Profile updated!');
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
     */
    public function edit($Movies)
    {
          MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $DbMovies = New_Movies::where('type', 'movies')->where('id', $Movies)->firstOrFail();
        $Tags = $DbMovies->Tags;
        $Categorys = Categorys::get();

        return view('admincp.Movies.edit', ['movies' => $DbMovies, "Data" => $DbMovies->tvdata, "Categorys" => $Categorys]);
    }

    /*
* Update the specified resource in storage.
*/
    public function update(Request $request, $Movies)
    {
          MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $apidata = new SimoPhp;
        $DbMovies = New_Movies::find($Movies);
        $movie = $apidata->PostData($request, "movie");
        $slug = Str::slug($request->addTiltle, '-');

        if ($DbMovies) {
            $DbMovies->title = $request->addTiltle;
            $DbMovies->title_org = $request->Title_tv_org;
            $DbMovies->content = $request->editor;
            $DbMovies->slug  = $slug;
            $DbMovies->tmdb_id  = $request->id_tmdb;
            $DbMovies->imdb_id  = $request->id_imdb;
            Auth::user()->UserMovies()->save($DbMovies);

            // start save info movies meta
            foreach ($movie as $key => $value) {
                  $info_movie = New_Movies_Meta::where('tv_id', $DbMovies->id)
                                                  ->where('simokey', $key)
                                                  ->where('type', 'movies')
                                                  ->first();
                if (isset($value)) {
                  $info_movie->simovalue =  $value;
                  $info_movie->user_id =  $DbMovies->user_id;
                  $DbMovies->tvdata()->save($info_movie);
                }
            }
            // end save info movies meta

            $apidata->Categorys($request->category, 'movies', $DbMovies->id);
            $apidata->Categorys($request->quality, 'movies', $DbMovies->id,"Quality");
            $apidata->Tags($request->Tags, 'movies', $DbMovies);
            $apidata->serversdb($request->player,$DbMovies,'movies','player');
            $apidata->serversdb($request->download,$DbMovies,'movies','download');
        }
        // end check
        $id = $DbMovies->id ?? $chek->id;
        return redirect('admincp/movies/edit/' . $id)->with('status', 'Profile updated!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function delete($movies)
    {     MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $user1 = New_Movies::where('type', 'movies')->Where('id', $movies)->firstOrFail();
        $user1->tvdata()->delete();
        $user1->Tags()->delete();
        $user1->delete();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function restore($movies)
    {

        MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $user1 = New_Movies::onlyTrashed()->where('type', 'movies')->Where('id', $movies)->firstOrFail();
        $user1->tvdata()->restore();
        $user1->Tags()->restore();
        $user1->restore();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($movies)
    {

        MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $user1 = New_Movies::onlyTrashed()->where('type', 'movies')->Where('id', $movies)->firstOrFail();
        $user1->forceDelete();
        $user1->Tags()->forceDelete();
        $user1->tvdata()->forceDelete();
        return back();
    }
    public function alldestroy()
    {

        MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $user1 = New_Movies::onlyTrashed()->where('type', 'movies')->get();
        foreach ($user1 as $key => $value) {
            $value->forceDelete();
            $value->tvdata()->forceDelete();
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function showdalet()
    {

        MyFunction::authorizes(['AdmincpSuper', 'Admincp']);
        $user1 = New_Movies::onlyTrashed()->where('type', 'movies')->simplePaginate(12);
        return view('admincp.Movies.Trashed', ["data" => $user1]);
    }
}
