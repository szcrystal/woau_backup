<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Auth;

class UserController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getIndex($user_number) {
    	if($user_number == 59999 && getenv('LARAVEL_ENV') == 'heroku') {
        	$authProfile = '管理者用のプロフィールページはありません';
        	return view('auth.profile', compact('authProfile'));
        }
        else {
        	$user = Auth::user();
            if($user->user_number == $user_number) {
                //$user = User::where('user_number', $user_number) -> first();
                $jobObjs = $user -> jobentries;
                $studyObjs = $user -> studyentries;
                $headTitle = "ユーザー情報";
                
                return view('auth.profile', ['user' => $user, 'jobObjs' => $jobObjs, 'studyObjs'=> $studyObjs, 'headTitle'=> $headTitle]);
            }
            else {
                //echo "Invalid Access : UserController->getEdit()"; //エラーページに遷移させるか
                abort(404);
            }
        }
    }


	//会員情報編集
    public function getEdit($user_number) {
    	
        if(Auth::user()->user_number == $user_number) {
    		$userObj = User::where('user_number', $user_number) -> first();
            $headTitle = 'ユーザー情報の編集';
        	return view('auth.register', ['userObj'=>$userObj, 'headTitle'=>$headTitle]);
        }
        else {
        	echo "Invalid Access : UserController->getEdit()";
        }
        
    }
    
    public function postEdit(Request $request, $user_number) {
    	$userObj = User::where('user_number', $user_number) -> first();
        
        $data = $request->all(); //$data:配列
        
        if($data['password'] == null) { //if($request->has('name') :documentのrequestページにあり
        	$userObj -> update([
                'name' => $data['name'],
                'email' => $data['email'],            
                //'user_number' => mt_rand(10000, 20000),
                'birth' => $data['birth_year'] . '/' . $data['birth_month'] . '/' . $data['birth_day'],
                'address' => $data['address'],
                'work_history' => $data['work_history'],
                'office_posi' => $data['office_posi'],
                'is_trip' => $data['is_trip'],
                'eng_ability' => $data['eng_ability'],
                'get_year' => $data['get_year'],
                'exp_type' => $data['exp_type'],
                'audit_posi' => $data['audit_posi'],
                //'other' => $data['other'],
                
                //'admin' => 10,
            ]);
        }
        else {
            $userObj -> update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                
                //'user_number' => mt_rand(10000, 20000),
                'birth' => $data['birth_year'] . '/' . $data['birth_month'] . '/' . $data['birth_day'],
                'address' => $data['address'],
                'work_history' => $data['work_history'],
                'office_posi' => $data['office_posi'],
                'is_trip' => $data['is_trip'],
                'eng_ability' => $data['eng_ability'],
                'get_year' => $data['get_year'],
                'exp_type' => $data['exp_type'],
                'audit_posi' => $data['audit_posi'],
                //'other' => $data['other'],
                
                //'admin' => 10,
            ]);
        }
        
        
        
//        if($editData['password'] != '') {
//        	$editData['password'] = bcrypt($editData['password']);
//            
//            $userObj->fill($editData);
//        	
//        }
//        else {
//        	foreach($editData as $key => $val) {
//            	if($key != 'password') 
//	            	$userObj->$key = $val;
//            }
//        }
//        
//        $userObj->save();
        
        
        //return view('auth.registerEnd')/* ->with(compact('editData'))*/;
    	return redirect('profile/'.$user_number)->with('status', 'ユーザー情報が更新されました');
    
    }
    



    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
