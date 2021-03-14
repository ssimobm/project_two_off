<?php

namespace App\Http\Controllers\AdminCp\Options;
use App\Http\Controllers\Controller;
use App\MyClass\MyFunction;
use App\Models\User;
use App\Models\Roles ;
use Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('admin');
      //$this->middleware('admin')->except(['index_ajax', 'index_update','DelletTypeAll']);
      // MyFunction::authorizes(['AdmincpSuper','Admincp','Editor']);



      //  $this->authorize("watch_now", auth()->user());

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);


        return view('admincp.Users.Users_index', ['users'=> $users->get()]);
    }

     public function error(Request $request)
      {
   $input = $request->all();
    $rules = [


             'email' => 'required|email|confirmed|max:255|same:email_confirmation',
             'email_confirmation' => 'required|email|same:email|max:255|min:4' ,
             'activedate'=> 'required' ,
              'select_role' => 'required|numeric',


    //  'user' => 'required|min:4|max:14|unique:users,username,'.auth()->user()->id.',id',
      'namefirst' => 'required|min:4|max:15',
          ];
    $messages = [
      //  'namefirst.required' => 'simoo is required',
        //'namefirst.min' => 'simoo must be max 255 length',
      //  'namefirst.max' => 'simoo must be max 10',
        // 'email.required' => 'email is required',
        // 'email.min' => 'email must be max 255 length',
        // 'email.max' => 'email must be max 10'
    ];

    $validator = Validator::make($input, $rules, $messages);
    $errors = $validator->errors();

    $arrayName = array('select_role' => $errors->first('select_role'),'activedate' => $errors->first('activedate'),'email_confirmation' => $errors->first('email_confirmation'), 'email' => $errors->first('email'), 'namefirst' => $errors->first('namefirst'),'user' => $errors->first("user"), );

    if (count($errors) > 0) {
      return ["errors" => $arrayName , "very" => true];
    }

      return ["errors" => $arrayName , "very" => false];


      }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $users, Roles $roles , $id)
    {

      MyFunction::authorizes(['AdmincpSuper','Admincp']);

        return view('admincp.Users.Users_edit', ['user'=> $users->find($id),'roles'=> $roles->get()]);
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
      MyFunction::authorizes(['AdmincpSuper','Admincp']);
          $input = $request->all();
           $rules = [

             'email' => 'required|email|confirmed|max:255|same:email_confirmation',
             'email_confirmation' => 'required|email|same:email|max:255|min:4' ,
             'activedate'=> 'required|in:True,Flase' ,
             'select_role' => 'required|numeric',

                    // 'user' => 'required|min:4|max:14|unique:users,username,'.auth()->user()->id.',id',
                     'namefirst' => 'required|min:4|max:15',
                 ];
           $messages = [
             //  'namefirst.required' => 'simoo is required',
               //'namefirst.min' => 'simoo must be max 255 length',
             //  'namefirst.max' => 'simoo must be max 10',
               // 'email.required' => 'email is required',
               // 'email.min' => 'email must be max 255 length',
               // 'email.max' => 'email must be max 10'
           ];
           $validator = Validator::make($input, $rules, $messages);

      $user = user::find($id) ;

      $UserMeta=$user->UserMeta;
      $UserMeta->simovalue = $request->select_role;
      $user->UserMeta()->save($UserMeta);
      $user->email = $request->email;
      //$user->username = $request->user;
      $user->name = $request->namefirst;

      if ($request->activedate === 'True') {
        date_default_timezone_set("africa/casablanca");
        $user->email_verified_at	 = date("Y-m-d h:i:s");
      }else {
        $user->email_verified_at	 = Null;
      }

      $user->save() ;

      return redirect()->back()->withErrors($validator)->withInput()->with('success', 'Saved Data has been successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function delet($id)
     {    MyFunction::authorizes(['AdmincpSuper','Admincp']);
         $user1 = user::find($id);


         $user1->delete() ;
         $user1->comments()->delete();
         $user1->UserFavorit()->delete();
         $user1->UserMeta()->delete();

         return redirect()->back()->withInput();

     }

     public function delet_index(User $users)
     {
       MyFunction::authorizes(['AdmincpSuper','Admincp']);


         return view('admincp.Users.Users_trached_index', ['users'=> $users->onlyTrashed()->get(),'users1'=> $users->get()]);
     }
    public function restore_get($id)
    {
      MyFunction::authorizes(['AdmincpSuper','Admincp']);

        $user1 = user::onlyTrashed()->find($id);


        $user1->restore();
        $user1->UserFavorit()->restore();
        $user1->comments()->restore();
        $user1->UserMeta()->restore();
        return back();
    }
    public function remove_get($id , $new_id)
    {
    MyFunction::authorizes(['AdmincpSuper','Admincp']);
      $user1 = user::onlyTrashed()->find($id);
      $user2 = user::find($new_id)->id;
      if (isset($user2) and isset($user1->id)) {
        foreach ($user1->UserMovies()->get() as $k => $v) {
         $v->user_id = $user2 ;
         $v->save() ;
        }
        $user1->forceDelete();
        $user1->UserFavorit()->forceDelete();
        $user1->comments()->forceDelete();
        $user1->UserMeta()->forceDelete();

        return redirect()->back()->withInput()->with('success', 'The deletion was successful');

      }
      return redirect()->back()->withInput()->with('error

      ', 'error no delet');
    }

    public function vidall()
    {
  MyFunction::authorizes(['AdmincpSuper','Admincp']);

  $user1 = user::onlyTrashed()->get();

  foreach ($user1 as $key => $value) {

    $value->forceDelete();

    $value->UserFavorit()->forceDelete();
    $value->comments()->forceDelete();
    $value->UserMeta()->forceDelete();

}
  return back();
}
public function index_update(\Auth $Auth ,\App\Models\Likes $Likes , Request $request)
{
  /// start authorizes user Notification
  MyFunction::authorizes(['AdmincpSuper','Admincp','Users']);

  /// start code remove user find Notification
  $simo = $Auth::user()->UserFavorit()->where('id', $request->ids)->first();

  if ($simo) {

    /// start code remove user find Notification
    if ($request->type === 'RemoveSelect') {
            $simo->forceDelete();
            return $request->type ;
    }
    //end remove user find

/// start code read and save user find Notification
    $simo->liks = 'read' ;
    $simo->save() ;
    $json = json_encode(["read" => $simo->liks , "nm" => count(user()->UserFavorit()->get()->where('liks', '1')), ]) ;
    return $json ;
  }

}

public function index_note(\Auth $Auth)
{

  MyFunction::authorizes(['AdmincpSuper','Admincp']);

  $simo = $Auth::user()->UserFavorit()->get();

  foreach ($simo->where('liks', 'new') as $key => $value) {
    $value->liks = 'post_read' ;
    $Auth::user()->UserFavorit()->save($value) ;
  }

  return view('sites.Users.Users_noti',['simo'=> $simo]);

}



public function note_update(\Auth $Auth , Request $request)
{
      MyFunction::authorizes(['AdmincpSuper','Admincp']);
$data_user = $Auth::user()->UserFavorit() ;
$count = $data_user->where('liks', 'new')->count() ;
$post_read = $data_user->get()->where('liks', 'post_read') ;
//$data = $data_user->where('liks_type', 'new')->where('liks', 'new')->orderBy('created_at', 'desc')->first();
$data = $data_user->where('liks_type', 'new')->where('liks', 'new')->where('created_at', '>=', date('Y-m-d H:i:s',strtotime("-10 sec")))->first();
if ($post_read) {
   foreach ($post_read as $key => $value) {
      $value->liks = 'read' ;
      $data_user->save($value) ;
    }
}
if ($data) {

    $data->liks = 'read' ;
    $data_user->save($data) ;
  $arrayName = array(
        'Nm' => $count,
        'name' => $data->Episodes->orderBy('created_at', 'desc')->first()->Name,
        'date' => $data->created_at->diffForHumans(),
        'id' => $data->id,


             );


    return json_encode($arrayName) ;
}

return '0' ;
}


}
