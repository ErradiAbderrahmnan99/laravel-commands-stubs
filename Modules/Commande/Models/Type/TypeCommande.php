<?php

namespace Modules\Commande\Models\Type;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCommande extends Model
{
    use HasFactory;

    protected $table = 'type_commande';

    protected $guarded = ["id"];
}




