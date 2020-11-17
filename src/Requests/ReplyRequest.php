<?php

namespace Qihucms\SiteHelp\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
            'site_help_id' => ['required', 'exists:site_helps,id'],
            'content' => ['required', 'max:1000'],
        ];
    }

    /**
     * @return array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public function attributes()
    {
        return trans('site-help::reply');
    }
}