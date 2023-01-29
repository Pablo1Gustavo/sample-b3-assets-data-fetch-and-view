<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LendingOpenPositionFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => ['date', 'before:end_date', 'before:tomorrow'],
            'end_date' => ['date', 'after:start_date', 'before:tomorrow'],
            'asset_id' => ['numeric']
        ];
    }
}
