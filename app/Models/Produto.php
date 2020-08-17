<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Produto extends Model
{
    protected $fillable = ['nome_produto','valor','loja_id','ativo'];

  	public $rules = ['nome_produto'  => 'required|min:3|max:60',
            		'valor' => 'required|min:2|max:7',
            		'loja_id' => 'required'
            		];


    public $messages = ['nome_produto.required' => 'O nome do produto é obrigatório',
                        'nome_produto.min' => 'O nome do produto precisa ter no mínimo 3 caracateres',
                        'nome_produto.max' => 'O nome do produto precisa ter no máximo 60 caracateres',
                        'valor.required' => 'O valor é obrigatório',
                        'valor.min' => 'O valor precisa ter no mínimo 2 caracateres',
                        'valor.max' => 'O valor precisa ter no máximo 7 caracateres',
            	       'loja_id.required' => 'O id da loja é obrigatório'];


    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

    public function getValorAttribute($valor): string
    {
        return 'R$ '. number_format($valor,2,',','');
    }

    public function getAtivoAttribute($ativo): bool
    {
        return $ativo;
    }

    public function getLinksAttribute($links): array
    {
        return [
            'self' => '/api/produtos/' . $this->id,
            'serie' => '/api/lojas/' . $this->loja_id
        ];
    }

}
