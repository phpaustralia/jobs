<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DocsController extends Controller
{
	public function show($page) 
	{
		$content = (new \Parsedown)->text(file_get_contents(base_path("docs/{$page}.md")));
		
		return view('blog', ['page' => $page, 'content' => $content ]);
	}
}
