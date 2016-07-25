<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $conversations = Auth::user()->conversations()->groupByCorrespondent(Auth::user()->id);

        return view('messages.index', ['conversations' => $conversations]);
    }
    
    public function store(Request $request)
    {
        $input = $request->all();

        $sender = Auth::user();

        $input['title'] = "new message from {$sender->name}";
        
        $message = Message::create($input);
        
        $message->from = $sender->id;
        
        $message->save();
        
        return response(['status' => 'success', 'message' => $message]);
    }
}
