<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDaysToKeepRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->is_manager || $this->user()->is_admin;
    }

    public function rules()
    {
        return [
            'days_to_keep' => 'required|integer|min:1'
        ];
    }
}
