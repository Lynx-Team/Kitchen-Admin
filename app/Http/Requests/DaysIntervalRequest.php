<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaysIntervalRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->is_manager || $this->user()->is_admin;
    }

    public function rules()
    {
        return [
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }
}
