<?php

namespace App\Http\Web\Product\Request;

use Illuminate\Foundation\Http\FormRequest;

class AvailabilityRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'product' => ['required:string'],
        ];
    }
}
