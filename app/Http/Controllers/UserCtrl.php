<?php

namespace App\Http\Controllers;

use App\Access;
use App\User;
use App\UserAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserCtrl extends Controller
{
    function __construct()
    {

    }

    public function index($edit = false, $info = null)
    {
        $check = AccessCtrl::allowProcess('users');
        if(!$check)
            return redirect('/');

        $keyword = Session::get('userKeyword');
        $data = User::select('*');
        if($keyword){
            $data = $data->where('username','like',"%$keyword%");
        }
        $data = $data->orderBy('username','asc')
            ->paginate(20);

        $access = Access::orderBy('name','asc')->get();
        return view('users',[
            'menu' => 'settings',
            'sub' => 'users',
            'data' => $data,
            'edit' => $edit,
            'info' => $info,
            'access' => $access
        ]);
    }

    public function search(Request $req)
    {
        Session::put('userKeyword',$req->keyword);
        return self::index();
    }

    public function save(Request $req)
    {
        $check = AccessCtrl::allowProcess('users');
        if(!$check)
            return redirect('/');

        $checkUsername = User::where('username',$req->username)->first();
        if($checkUsername)
            return redirect()->back()->with('status','duplicate');

        $u = User::create([
            'name' => $req->name,
            'username' => $req->username,
            'level' => $req->level,
            'password' => bcrypt($req->password)
        ]);

        if(count($req->access)>0)
        {
            UserAccess::where('user_id',$u->id)->delete();
            foreach($req->access as $access)
            {
                $data = array(
                    'user_id' => $u->id,
                    'page' => $access
                );
                UserAccess::create($data);
            }
        }
        return redirect()->back()->with('status','saved');
    }

    public function edit($id)
    {
        $info = User::find($id);
        if(!$info)
            return redirect('/users');

        return self::index(true,$info);
    }

    public function update(Request $req, $id)
    {
        $check = AccessCtrl::allowProcess('users');
        if(!$check)
            return redirect('/');

        if(count($req->access)>0)
        {
            UserAccess::where('user_id',$id)->delete();
            foreach($req->access as $access)
            {
                $data = array(
                    'user_id' => $id,
                    'page' => $access
                );
                UserAccess::create($data);
            }
        }

        $data = array(
            'name' => $req->name,
            'username' => $req->username,
            'level' => $req->level,
        );
        if($req->password)
        {
            $data['password'] = bcrypt($req->password);
        }
        User::find($id)
            ->update($data);
        return redirect()->back()->with('status','updated');
    }

    public function delete($id)
    {
        $check = AccessCtrl::allowProcess('users');
        if(!$check)
            return redirect('/');

        User::find($id)->delete();
        return redirect('/users')->with('status','deleted');
    }

    function createUser()
    {
        User::create([
            'level' => 'judge',
            'username' => '%aTZGa',
            'password' => bcrypt('aTZGa')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'nRD$D%',
            'password' => bcrypt('nRD$D%')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'sj&RPd',
            'password' => bcrypt('sj&RPd')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'q3FM&7',
            'password' => bcrypt('q3FM&7')
        ]);

        User::create([
            'level' => 'judge',
            'username' => '%!Ek3x',
            'password' => bcrypt('Ek3x')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'tT#0Oa',
            'password' => bcrypt('tT#0Oa')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'iw41$T',
            'password' => bcrypt('iw41$T')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'aKfM!7',
            'password' => bcrypt('aKfM!7')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'nU%PH*',
            'password' => bcrypt('nU%PH*')
        ]);

        User::create([
            'level' => 'judge',
            'username' => '8lK3&x',
            'password' => bcrypt('8lK3&x')
        ]);

        User::create([
            'level' => 'judge',
            'username' => '^CCqze',
            'password' => bcrypt('CCqze')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'cOSg!A',
            'password' => bcrypt('cOSg!A')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'x#wFK*',
            'password' => bcrypt('x#wFK*')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'jTu#&N',
            'password' => bcrypt('jTu#&N')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'Wccr!x',
            'password' => bcrypt('Wccr!x')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'AbhWE^',
            'password' => bcrypt('AbhWE^')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'oEq%6Y',
            'password' => bcrypt('oEq%6Y')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'aMa%%q',
            'password' => bcrypt('aMa%%q')
        ]);

        User::create([
            'level' => 'judge',
            'username' => 'LEF*Md',
            'password' => bcrypt('LEF*Md')
        ]);

        User::create([
            'level' => 'judge',
            'username' => '*HuBvx',
            'password' => bcrypt('HuBvx')
        ]);

    }
}
