<?php

namespace App\Http\Requests;

use App\Features\Masters\Constants\UsersConstants;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            $array = UsersConstants::UPDATE_RULES;
            $array['email'][] = "unique:users,email,". auth()->user()->id;
            return $array;
        ];
    }
}
