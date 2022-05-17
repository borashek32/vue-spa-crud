<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePostForm extends FormRequest
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
      'title'        => 'required|min:3|max:255',
      'description'  => 'required|min:10|max:255'
    ];
  }

  public function messages()
  {
    return [
      'title.required'       => 'Field "Title" is required',
      'title.min:3'          => 'Field "Title" should be from 3 to 255 symbols',
      'title.min:255'        => 'Field "Title" should be from 3 to 255 symbols',
      'description.required' => 'Field "Description" is required',
      'description.min:3'    => 'Field "Description" should be from 10 to 255 symbols',
      'description.min:255'  => 'Field "Description" should be from 10 to 255 symbols'
    ];
  }
}
