<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceFile extends Model
{
    protected $table = "resource_file";
    protected $guarded = [];

    const LANGUAGE = [
        'ja', 'en'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class, "code_file_id");
    }
}
