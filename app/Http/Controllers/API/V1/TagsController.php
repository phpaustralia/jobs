<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('q');

        $query = Tag::query();
        
        if ($q) {
            $query->where('name', 'like', "%$q%");
        }
        
        return [
            'data' =>
                    $query->get()
        ];
    }
}
