<?php

namespace CeddyG\ClaraEvent\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'id_event'          => 'numeric',
            'fk_event_category' => 'numeric',
            'name_event'        => 'string|max:45',
            'date_begin'        => 'string',
            'date_end'          => 'string',
            'color_event'       => 'string|max:15',
            'description_event' => '',
            'created_at'        => 'string',
            'updated_at'        => 'string'
        ];
    }
}

