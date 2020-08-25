<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\User;
use Illuminate\Http\Request;

class JudgeCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    function index()
    {
        $data = User::orderBy('username','asc')
            ->where('level','judge')
            ->get();

        return view('judge',[
            'menu' => 'add_judge',
            'data' => $data
        ]);
    }

    static function countRate($id)
    {
        return Criteria::where('user_id',$id)->count();
    }

    function delete($id)
    {
        User::find($id)->delete();
        Criteria::where('user_id',$id)->delete();
        return redirect()->back()->with('status','delete');
    }

    function save(Request $req)
    {
        $check = User::where('username',$req->username)->first();
        if($check)
            return redirect()->back()->with('status','duplicate');

        User::create([
            'level' => 'judge',
            'username' => $req->username,
            'password' => bcrypt($req->password)
        ]);
        return redirect()->back()->with('status','save');
    }
}
