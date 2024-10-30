<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'user_id' => 'required|exists:users,id', // تحقق من أن user_id موجود في جدول users
            'first_name' => 'required|string|max:255', // الحقل إلزامي، نص، والطول الأقصى 255
            'last_name' => 'required|string|max:255', // الحقل إلزامي، نص، والطول الأقصى 255
            'birthday' => 'nullable|date|before:today', // الحقل يمكن أن يكون فارغًا، ويجب أن يكون تاريخًا صالحًا إذا تم إدخاله
            'gender' => 'nullable|in:male,female', // الحقل يجب أن يحتوي على "male" أو "female" إذا تم إدخاله
            'street_address' => 'nullable|string|max:255', // عنوان الشارع يمكن أن يكون فارغًا والنص بطول أقصى 255
            'city' => 'required|string|max:255', // الحقل إلزامي والنص بطول أقصى 255
            'postal_code' => 'nullable|string|max:20', // الرمز البريدي يمكن أن يكون فارغًا والنص بطول أقصى 20
            'country' => 'required|string|size:2', // الدولة إلزامية، وتكون عبارة عن كود مكون من حرفين (ISO)
            'locale' => 'nullable|string|size:2', // اللغة يمكن أن تكون فارغة، مكونة من حرفين (مثل "en" أو "ar")
            'state' => 'nullable|string|max:100', // الولاية يمكن أن تكون فارغة والنص بطول أقصى 100
        ];
    }
}
