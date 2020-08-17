<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Repositories\ProdutoRepository;
use App\Models\Produto;

class ProdutosController extends BaseController
{
    public function __construct(ProdutoRepository $produtoRepository, Produto $produto, Request $request)
    {
        $this->classeRepository = $produtoRepository;
        
        $this->rules = $produto->rules;
        $this->classeModel = $produto;
    }    

    public function buscaPorLoja(int $lojaId)
    {
        try {
            return $this->classeRepository->getByLoja($lojaId);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }        

        
    
}
