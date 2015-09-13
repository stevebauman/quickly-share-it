<?php

namespace App\Http\Requests;

class BatchUnlockRequest extends Request
{
    /**
     * The batch unlock rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required'
        ];
    }

    /**
     * Allow all users to unlock batches.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
