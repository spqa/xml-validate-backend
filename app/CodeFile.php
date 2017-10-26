<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeFile extends Model
{
    protected $table = "code_file";
    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class, "code_file_id");
    }
}
