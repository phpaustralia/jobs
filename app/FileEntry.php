<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileEntry extends Model
{

    public $table = 'files';
    
    protected $guarded = [];

    public function getFromUpload($file)
    {
        $this->name = $file->getClientOriginalName();

        $this->mimetype = $file->getClientMimeType();

        $this->path = time().$file->getClientOriginalName();

        $this->size = $file->getClientSize();

        File::move($file->getRealPath(), storage_path() . '/app/' . $this->path);

        $this->save();
    }
}
