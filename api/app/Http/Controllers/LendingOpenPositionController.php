<?php
namespace App\Http\Controllers;

use App\Models\LendingOpenPosition;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LendingOpenPositionFilterRequest;

class LendingOpenPositionController extends Controller
{
    public function getAll(LendingOpenPositionFilterRequest $request): JsonResponse
    {
        $request->validated();
        
        $query = LendingOpenPosition
            ::when($request->start_date, fn($q, $startDate) => 
                $q->startDate($startDate)
            )
            ->when($request->end_date, fn($q, $endDate) =>
                $q->endDate($endDate)
            )
            ->when($request->asset, fn($q, $asset) =>
                $q->asset($asset)
            )
        ;

        return response()->json(
            $query->get()
        );
    }

    public function getOne(): JsonResponse
    {
        return response()->json(
            LendingOpenPosition::findOrFail($this->request->id)
        );
    }
}
