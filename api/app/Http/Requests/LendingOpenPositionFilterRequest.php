<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LendingOpenPositionFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => ['date', 'before_or_equal:end_date', 'before_or_equal:today'],
            'end_date' => ['date', 'after_or_equal:start_date', 'before_or_equal:today'],
            'asset_id' => ['numeric']
        ];
    }
}
