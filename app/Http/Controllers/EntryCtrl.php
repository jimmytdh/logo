<?php

namespace App\Http\Controllers;

use App\Criteria;
use App\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EntryCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('login');
    }

    function view($entry=0,$info=array())
    {
        $data = Entry::orderBy('entry_no','asc')->get();
        return view('view_entry',[
            'menu' => 'view_entry',
            'data' => $data,
            'entry' => $entry,
            'info' => $info
        ]);
    }

    function viewById($id)
    {
        $info = Entry::find($id);
        return self::view($id,$info);
    }

    function add()
    {
        $data = Entry::orderBy('entry_no','asc')->get();

        return view('add_entry',[
            'menu' => 'add_entry',
            'data' => $data
        ]);
    }

    function save(Request $req)
    {
        $entry_no = $req->entry_no;
        $name = $req->name;
        $file = $req->file('logo');
        $extension = $file->getClientOriginalExtension();
        $file_name = $entry_no . "." . $extension;
        Storage::disk('upload')->put($file_name, File::get($file));

        Entry::create([
            'entry_no' => $entry_no,
            'name' => $name,
            'path' => $file_name
        ]);

        return redirect()->back()->with('status','save');
    }

    function delete($id)
    {
        Entry::find($id)->delete();
        Criteria::where('entry_id',$id)->delete();

        return redirect()->back()->with('status','delete');
    }

    static function getValue($entry_id,$value)
    {
        $user = Session::get('user');
        $c = Criteria::where('user_id',$user->id)
                ->where('entry_id',$entry_id)
                ->first();
        if(!$c)
            return 0;
        return $c->$value;
    }

    function vote(Request $req, $entry_id)
    {
        $user = Session::get("user");
        $match = array(
            'user_id' => $user->id,
            'entry_id' => $entry_id
        );

        $total = $req->concept+
            $req->relevance+
            $req->originality+
            $req->creativity+
            $req->impact;

        Criteria::updateOrCreate($match,[
            'concept' => $req->concept,
            'relevance' => $req->relevance,
            'originality' => $req->originality,
            'creativity' => $req->creativity,
            'impact' => $req->impact,
            'total' => $total
        ]);

        return redirect()->back()->with('status','save');
    }

    static function submitChecker($entry_id)
    {
        $user = Session::get("user");
        $c = Criteria::where('user_id',$user->id)
                    ->where('entry_id',$entry_id)
                    ->first();
        if(!$c)
            return false;
        return true;
    }
}
