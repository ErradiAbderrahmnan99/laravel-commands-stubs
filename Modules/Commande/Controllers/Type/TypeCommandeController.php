<?php

namespace Modules\Commande\Controllers\Type;

use App\Http\Controllers\Controller;
use Modules\Commande\Models\Type\TypeCommande;


class TypeCommandeController extends Controller
{

    public function index(){
        $type = TypeCommande::all();
        return $type;
    }

}
