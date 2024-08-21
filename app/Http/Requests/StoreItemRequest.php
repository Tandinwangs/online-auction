<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'starting_bid' => 'required|numeric|min:0',
            'current_bid' => 'nullable|numeric|min:0',
            'reserve_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'auction_reference_id' => 'required|exists:auction_references,id',
            'user_id' => 'required|exists:users,id',
            'auction_start' => 'required|date|after_or_equal:today',
            'auction_end' => 'required|date|after:auction_start',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
