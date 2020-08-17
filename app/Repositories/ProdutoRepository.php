<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Loja;
use App\Notifications\ProdutoSalvoNotification;
use App\Services\NotificacaoProdutoService;

class ProdutoRepository  implements RepositoryInterface
{
	private $produto;
	private $notificacaoProdutoService;

	public function __construct(Produto $produto, NotificacaoProdutoService $notificacaoProdutoService)
	{
		$this->produto = $produto;
		$this->notificacaoProdutoService = $notificacaoProdutoService;			
	}

	public function getAll()
	{
		return $this->produto->all(); //paginate();
	}

	public function get($id)
	{
		return $this->produto->find($id);
	}

	public function getByLoja($lojaId)
	{
		return $this->produto->where('loja_id',$lojaId); //paginate();
	}

	public function create(Request $request)
	{
		$loja = Loja::find($request->loja_id);
		if (is_null($loja)) {
			$request->message = ["loja_id" => "Loja não encontrada"];
			return null;
		}

		$produto = Produto::where('loja_id',$request->loja_id)->where('nome_produto',$request->nome_produto)->get();
		if ($produto->count()>0) {
			$request->message = ["nome_produto" => "Este produto já existe neste Loja"];
			return null;
		}
		

		$produto = $this->produto->create($request->all());
		$this->notificacaoProdutoService->notificaProduto($loja, $produto, $request);			
		return $produto;	
	}

	public function update($id, Request $request)
	{
		$loja = Loja::find($request->loja_id);
		if (is_null($loja)) {
			$request->message = ["loja_id" => "Loja não encontrada"];
			return null;
		}
		$produto = $this->produto->find($id);
		if (!is_null($produto))
		{
			$produto->update($request->all());
			$this->notificacaoProdutoService->notificaProduto($loja, $produto, $request);
			return $produto;
		} 
		
	}

	public function destroy($id)
	{
		return $this->produto->destroy($id);
	}



}