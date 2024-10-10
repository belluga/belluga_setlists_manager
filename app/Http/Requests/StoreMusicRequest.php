<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMusicRequest extends FormRequest {
    public function authorize(): bool{
        return true;
    }

    public function rules(): array {
        return [
            'name' => ['required', 'max:70'],
            'tone' => ['required', 'max:5']
        ];
    }
}
