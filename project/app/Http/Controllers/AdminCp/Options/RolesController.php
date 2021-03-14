<?php

namespace App\Http\Controllers\AdminCp\Options;
use App\Http\Controllers\Controller;

use App\Models\Roles;
use App\Models\User;
use App\MyClass\MyFunction;

use Illuminate\Http\Request;
use Gate ;
class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
         $this->middleware('admin');
     }


    public function index(Roles $Roles)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);
      $Roles = $Roles::get() ;
      return view('admincp.Users.Roless_index' , ['Roles'=> $Roles]);
    }


    public function edit(Roles $Roles , $ids)
    {

     MyFunction::authorizes(['AdmincpSuper','Admincp']);


    //  $this->authorize("Admincp", auth()->user());
    //  $this->authorize("watch_now", auth()->user());
      $Roles = $Roles::find($ids) ;
      $data = json_decode($Roles->type_value) ;

            return view('admincp.Users.Roless' , ['Roles'=> $data , 'ids'=> $Roles->id ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $Roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $Roles ,$ids)
    {
     MyFunction::authorizes(['AdmincpSuper','Admincp']);
    $Roles = $Roles::find($ids) ;
    $Roles->name = $Roles->name;
    $Roles->type = $Roles->type;

    $Roles->type_value = json_encode($request->Copy);
    $Roles->save();
return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $Roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $Roles)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);
    }
}
