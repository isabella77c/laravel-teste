<?php 


namespace App\Services;
use App\Notifications\ProdutoSalvoNotification;
use App\Models\Loja;
use App\Models\Produto;
use Illuminate\Http\Request;


class NotificacaoProdutoService
{
	private $produtoSalvoNotification;	

	public function __construct(ProdutoSalvoNotification $produtoSalvoNotification)
	{
		$this->produtoSalvoNotification = $produtoSalvoNotification;
	}

	public function notificaProduto(Loja $loja, Produto $produto, Request $request)
	{
		try {
			$loja->notify(new ProdutoSalvoNotification($produto));
        } catch (Exception $exception) {
            $request->message = ['error' => 'Erro ao enviar a notificação por e-mail'];
        }
	}	
	
}