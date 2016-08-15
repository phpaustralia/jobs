<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\File;

class DocsController extends Controller
{
	public function show($page) 
	{
		$path = base_path("docs/{$page}.md");

		if(!File::exists($path)) {
			abort(404);
		}

		$content = (new \Parsedown)->text(File::get($path));
		
		return view('blog', ['page' => $page, 'content' => $content ]);
	}
}
