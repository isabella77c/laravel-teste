<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController
{
    protected $classeRepository;
    protected $rules;
    protected $classeModel;


    public function index(Request $request)
    {        
        try {
            return $this->classeRepository->getAll();
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),  
                                     $this->classeModel->rules,
                                     $this->classeModel->messages);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $recurso = $this->classeRepository->create($request);
            if (is_null($recurso))
                return response()->json($request->message, Response::HTTP_NOT_FOUND);
            else return response()->json($recurso, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function show(int $id)
    {
        try {
            $recurso = $this->classeRepository->get($id);
            if (is_null($recurso)) {
                return response()->json('', Response::HTTP_NO_CONTENT);
            }

            return response()->json($recurso,Response::HTTP_OK);

        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(int $id, Request $request)
    {
        
        $validator = Validator::make($request->all(),  
                                     $this->rules,
                                     $this->classeModel->messages);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        try {
            $recurso = $this->classeRepository->update($id, $request);
            if (is_null($recurso))
            {
                return response()->json(['error' => 'Recurso não encontrado'], Response::HTTP_NOT_FOUND);    
            }

            return response()->json($recurso, Response::HTTP_CREATED);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function destroy(int $id)
    {
        try {

            $qtdeApagada = $this->classeRepository->destroy($id);
            if ($qtdeApagada === 0) {
                return response()->json(['error' => 'Recurso não encontrado'], Response::HTTP_NOT_FOUND);
            }

            return response()->json('', 200);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
