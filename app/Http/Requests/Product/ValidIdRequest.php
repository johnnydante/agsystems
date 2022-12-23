<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ValidIdRequest extends FormRequest
{
    public function validationData(): array
    {
        $id = request()->route('id');
        return array_merge($this->all(), ['id' => $id]);
    }

    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:products,id',
        ];
    }
}
