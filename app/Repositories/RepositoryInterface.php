<?php 
namespace App\Repositories;
use Illuminate\Http\Request;

interface RepositoryInterface
{
	public function getAll();
	public function get($id);
	public function create(Request $request);
	public function update($id, Request $request);
	public function destroy($id);

}

 
