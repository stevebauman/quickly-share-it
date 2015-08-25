<?php

namespace App\Http\Requests;

class BatchLockRequest extends Request
{
    /**
     * The batch lock rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required_if:password_required,yes|confirmed',
            'password_confirmation' => 'required_with:password',
        ];
    }

    /**
     * Allow all users to lock their own batches.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
