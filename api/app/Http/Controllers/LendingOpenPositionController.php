<?php
namespace App\Http\Controllers;

use App\Models\LendingOpenPosition;
use Illuminate\Http\JsonResponse;

class LendingOpenPositionController extends Controller
{
    public function getAll(): JsonResponse
    {
        return response()->json(
            LendingOpenPosition::all()
        );
    }

    public function getOne(): JsonResponse
    {
        return response()->json(
            LendingOpenPosition::findOrFail($this->request->id)
        );
    }
}
