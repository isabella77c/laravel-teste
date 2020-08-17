<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LojaRepository;
use App\Models\Loja;

class LojasController extends BaseController
{
    public function __construct(LojaRepository $lojaRepository, Loja $loja, Request $request)
    {
        $this->classeRepository = $lojaRepository;
        
        $this->rules = $loja->rules;
        $this->rules['email'] .= ',email,'.$request->id;
        $this->classeModel = $loja;
        

    }    
}
