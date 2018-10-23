<?php

namespace CeddyG\ClaraEvent\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventCategoryRequest extends FormRequest
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
            'id_event_category'     => 'numeric',
            'name_event_category'   => 'string|max:45',
            'color_event_category'  => 'string|max:20',
            'created_at'            => 'string',
            'updated_at'            => 'string'
        ];
    }
}

