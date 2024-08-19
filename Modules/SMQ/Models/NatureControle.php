<?php

declare(strict_types=1);

namespace Modules\SMQ\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureControle extends Model
{
    use HasFactory;

    protected $table = 'naturecontrole';

    protected $guarded = ["id"];
}




