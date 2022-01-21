<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachStatusFiles extends Model
{
    use HasFactory;
    protected $table = "attach_status_files";

    public function filesStatus()
    {
        return $this->hasMany(FilesStatus::class, 'id_attach_status_file');
    }

    public function campania()
    {
        return $this->belongsTo(Campanias::class, 'id_campania');
    }
}