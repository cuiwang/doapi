<?php

namespace App\Http\Requests;



class ProjectUpdateRequest extends Request
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
            'name' => [
                'required',
                'max:16',
            ],
            'description' => [
                'required',
                'max:255',
            ],
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(){
        return [
                'name.required' => '名称不能为空',
                'name.unique' => '名称已被占用',
                'name.max' => '名称最长16位',
                'description.required' => '应用简介不能为空',
                'description.max' => '应用简介最多255个字符',
        ];
    }


}
