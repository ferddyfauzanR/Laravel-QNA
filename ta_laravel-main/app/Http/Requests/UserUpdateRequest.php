<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = $this->route('user');

        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($userId)
            ],
            'username' => [
                'required',
                function ($attribute, $value, $fail) use ($userId) {
                    if ($value) {
                        $existingUser = User::where('username', $value)->first();

                        if ($existingUser) {
                            if ($existingUser->id !== $userId) {
                                $fail('Username telah digunakan oleh pengguna lain.');
                            }
                        }
                    }
                }
            ]
        ];
    }
}
