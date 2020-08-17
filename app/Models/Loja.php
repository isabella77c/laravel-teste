<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Loja extends Model
{
    use Notifiable;

    protected $fillable = ['nome_loja','email'];
    //protected $appends = ['links'];

  	public $rules = ['nome_loja'  => 'required|min:3|max:40',
            		'email' => 'required|email|max:200|unique:lojas'];


    public $messages = ['nome_loja.required' => 'O nome da loja é obrigatório',
                'nome_loja.min' => 'O nome da loja precisa ter no mínimo 3 caracateres',
                'nome_loja.max' => 'O nome da loja precisa ter no máximo 100 caracateres',
                'email.required' => 'O e-mail é obrigatório',
                'email.email' => 'E-mail inválido',
                'email.unique' => 'Este e-mail já está cadastrado'];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function getLinksAttribute($links): array
    {
        return [
            'self' => '/api/lojas/' . $this->id,
            'produtos' => '/api/lojas/' . $this->id . '/produtos'
        ];
    }

}
