<?php

namespace Modules\SMQ\Models\Nature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    use HasFactory;

    protected $table = 'nature';

    protected $guarded = ["id"];
}




