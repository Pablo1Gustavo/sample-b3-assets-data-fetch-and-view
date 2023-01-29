<?php
namespace App\Http\Controllers;

use App\Models\TickerSymbol;
use Illuminate\Http\JsonResponse;

class TickerSymbolController extends Controller
{

    public function getAll(): JsonResponse
    {
        return response()->json(
            TickerSymbol::all()
        );
    }

    public function getOne(): JsonResponse
    {
        return response()->json(
            TickerSymbol::findOrFail($this->request->id)
        );
    }
}
