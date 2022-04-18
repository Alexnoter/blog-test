<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    /* esto es para que el usuario no pueda alterar nuestro codigo  */
    public function authorize()
    {
        if ($this->user_id == auth()->user()->id) {
            return true;
        }else {
            return false; 
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /* esto seria en caso de que el post  sea  en borrador y el dos es en publico */
        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2'
        ];
        /* el metodo array_merge nos fuciona dos  array 
        en este caso fucionaremos el antiguo rules con el nuevo */
        if ($this->status == 2) {
            $rules = array_merge($rules, [
                'category_id' => 'required',
                'tags' => 'required',
                'extract' => 'required',
                'body' => 'required'
            ]);
        }

        return $rules;
    }
}
