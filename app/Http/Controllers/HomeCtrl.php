<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\Entry;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    public function index(){
        $no_entry = Entry::count();
        $no_judge = User::where('level','judge')->count();

        $data = Criteria::groupBy('entry_id')
            ->selectRaw('avg(total) as total,entry_id,count(*) as judges')
            ->orderBy('judges','desc')
            ->orderBy('total','desc')
            ->get();

        return view('result',[
            'menu' => 'home',
            'data' => $data,
            'no_entry' => $no_entry,
            'no_judge' => $no_judge
        ]);
    }

    function result()
    {
        $data = Criteria::groupBy('entry_id')
                ->selectRaw('avg(total) as total,entry_id,count(*) as judges')
                ->orderBy('total','desc')
                ->get();

        return view('result',[
            'menu' => 'result',
            'data' => $data
        ]);
    }

    static function entryInfo($id)
    {
        return Entry::find($id);
    }
}
