<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesStatus extends Model
{
    use HasFactory;

    protected $table = "files_status";

    public function attachStatusFles()
    {
        # code...
        return $this->belongsTo(AttachStatusFiles::class, 'id_attach_status_file');
    }
}