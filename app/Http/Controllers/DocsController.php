<?php

namespace App\Http\Controllers;

use App\PHPAustralia\Docs;
use App\Http\Requests;

class DocsController extends Controller
{
    
    public function show($page)
    {
        $content = Docs::get($page);
        
        if ($content == null) {
            abort(404);
        }
        
        return view('blog', ['page' => $page, 'content' => $content ]);
    }
}
