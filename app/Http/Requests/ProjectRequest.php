<?php

namespace App\Http\Requests;



class ProjectRequest extends Request
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
            'url' => [
                'required',
                'min:4',
                'max:16',
                'unique:projects,url',
                'regex:/^\w+$/',
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
                'url.required' => '页面地址不能为空',
                'url.unique' => '页面地址已被占用',
                'url.min' => '页面地址最少4位',
                'url.max' => '页面地址最多16位',
                'url.regex' => '异常字符!请不要填写除字母,数字和下划线以外的字符',
                'description.required' => '应用简介不能为空',
                'description.max' => '应用简介最多255个字符',
        ];
    }


}
