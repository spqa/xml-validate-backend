<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "message";
    protected $fillable = ["ja", "vi", "en", "message_key", "final", "applied", "tested", "code_file_id", "resource_file_id", "customer_support"];
    protected $with = ["code_file", "resource_file"];

    public function code_file()
    {
        return $this->belongsTo(CodeFile::class, "code_file_id");
    }

    public function resource_file()
    {
        return $this->belongsTo(ResourceFile::class, "resource_file_id");
    }
}
