<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cartao;
use Response;

class CartaoController extends Controller
{
    protected $cartao = null;

    public function __construct(Cartao $cartao)
    {
        $this->cartao = $cartao;
    }

    public function allCartoes(Request $request, $tokenJson)
    {
        $request->header('Access-Control-Allow-Origin', '*');  
        return Response::json($this->cartao->allCartoes($tokenJson), 200);
    }
}
