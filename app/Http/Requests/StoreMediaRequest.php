<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPatch = $this->isMethod('PATCH');
        $mediaId = $this->route('medium')?->id ?? $this->route('media');

        return [
            'title'    => $isPatch
                ? 'sometimes|string|max:255|unique:media,title,' . $mediaId
                : 'required|string|max:255|unique:media,title',
            'type'     => $isPatch ? 'sometimes|in:movie,series' : 'required|in:movie,series',
            'genre'    => $isPatch ? 'sometimes|string|max:100' : 'required|string|max:100',
            'year'     => $isPatch ? 'sometimes|integer|min:1900|max:2100' : 'required|integer|min:1900|max:2100',
            'duration' => 'nullable|integer|min:1',
            'episodes' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi',
            'title.unique'   => 'Judul media sudah terdaftar di FlipPlay',
            'type.in'        => 'Jenis media harus berupa movie atau series',
        ];
    }
}
