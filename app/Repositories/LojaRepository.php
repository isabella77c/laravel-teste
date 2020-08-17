<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Models\Loja;
use App\Models\Produto;



class LojaRepository  implements RepositoryInterface
{
	private $loja;

	public function __construct(Loja $loja)
	{
		$this->loja = $loja;
	}

	public function getAll()
	{
		return $this->loja->all(); //paginate();
	}

	public function get($id)
	{
		return Loja::query('id', '=', $id)->with('produtos')->get();
	}

	public function create(Request $request)
	{
		return $this->loja->create($request->all());	
	}

	public function update($id, Request $request)
	{
		$recurso = $this->loja->find($id);
		if (!is_null($recurso))
			$recurso->update($request->all());
		return $recurso;
	}

	public function destroy($id)
	{
		return $this->loja->destroy($id);
	}
}