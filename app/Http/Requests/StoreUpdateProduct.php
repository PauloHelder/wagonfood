<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateProduct extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $uuid = $this->segment(3);
        $rules =  [
            'tittle' => ['required', 'string', 'max:255', "unique:products,title,{$uuid},uuid"],
            'description' => ['required','min:3','max:255'],
            'image' => ['required', 'image'],
        ];
       
        if($this->method() == 'PUT'){
            $rules['image'] = ['nullable', 'image'];
        }


        return $rules;
    }
}
