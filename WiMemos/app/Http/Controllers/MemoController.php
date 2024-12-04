<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memos;

class MemoController extends Controller
{
    public function add(Request $request)
    {
        try {
            if(empty($request->title) || empty($request->content)){
                return to_route('view_formmemo')->with('message', 'Title or Content is empty !');
            }
            $memo = new Memos;
            $memo->title = $request->title;
            $memo->content = $request->content;
            $memo->save();
            return to_route('view_Account')->with('message', 'Memo added successfully');
        } catch (\Exception $e) {
            return to_route('view_Account')->with('message', 'Failed to add memo: ' . $e->getMessage());
        }
    }

    public function show(Request $request) 
    {
        // Open view_memo with all the memos
        return view('memolist', ['memos' => Memos::all()]);
    }
    
}
