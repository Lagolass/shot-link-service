<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateShortLink extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'link' => ['required', 'url', 'max:500', 'active_url'],
            'limit' => ['required', 'numeric', 'min:0'],
            'lifetime' => ['required', 'numeric', 'between:1,24'],
        ];
    }

    public function getSanitized(): array
    {
        $sanitized = $this->validated();

        $sanitized['token'] = Str::random(8);
        $sanitized['expires'] = Carbon::now()->addHours($sanitized['lifetime']);

        return $sanitized;
    }
}
