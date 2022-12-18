<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\HistoricBalance;

class CreateHistoricBalanceRequest extends FormRequest
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
        $type = $this->request->get('type');
        $rules = HistoricBalance::$rules;
        if($type){
            $rules['receipt.*'] = 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg';
        }
        return $rules;
    }
}
