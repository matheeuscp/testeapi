<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Response;

class ProdutoController extends Controller
{
    protected $prod = null;

    public function __construct(Produto $prod)
    {
        $this->prod = $prod;
    }

    public function allProducts(Request $request, $tokenJson)
    {
        $request->header('Access-Control-Allow-Origin', '*');  
        return Response::json($this->prod->allProducts($tokenJson), 200);
    }

    // public function saveCartao()
    // {
    //     return Response::json($this->prod->saveCartao(),200);
        
    // }
}
