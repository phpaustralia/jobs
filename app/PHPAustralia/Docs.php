<?php

namespace App\PHPAustralia;

use Illuminate\Support\Facades\File;

class Docs
{
    public static function all()
    {
        return collect(File::files(base_path("docs")))->map(function ($path) {
            return File::name($path);
        });
    }
    
    public static function get($page)
    {
        $path = base_path("docs/{$page}.md");

        if (!File::exists($path)) {
            return null;
        }

        return (new \Parsedown)->text(File::get($path));
    }
}
