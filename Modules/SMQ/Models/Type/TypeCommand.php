<?php

namespace Modules\SMQ\Models\Type;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCommand extends Model
{
    use HasFactory;

    protected $table = 'typecommand';

    protected $guarded = ["id"];
}




