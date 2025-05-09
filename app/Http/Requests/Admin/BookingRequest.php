<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'arena_id' => 'required|numeric',
                    'time_from' => [
                        'required',
                        'date_format:Y-m-d H:i',
                        function ($attribute, $value, $fail) {
                            $conflict = \App\Models\Booking::where('arena_id', $this->arena_id)
                                ->where(function ($query) use ($value) {
                                    $query->where(function ($query) use ($value) {
                                        $query->where('time_from', '<', $this->time_to)
                                              ->where('time_to', '>', $value);
                                    });
                                })
                                ->exists();

                            if ($conflict) {
                                $fail('Waktu yang dipilih sudah dipesan. Silakan pilih waktu lain.');
                            }
                        }
                    ],
                    'time_to' => 'required|date_format:Y-m-d H:i|after:time_from',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'arena_id' => 'required|numeric',
                    'time_from' => [
                        'required',
                        'date_format:Y-m-d H:i',
                        function ($attribute, $value, $fail) {
                            $bookingId = $this->route('booking')->id;
                            $conflict = \App\Models\Booking::where('arena_id', $this->arena_id)
                                ->where('id', '!=', $bookingId)
                                ->where(function ($query) use ($value) {
                                    $query->where(function ($query) use ($value) {
                                        $query->where('time_from', '<', $this->time_to)
                                              ->where('time_to', '>', $value);
                                    });
                                })
                                ->exists();

                            if ($conflict) {
                                $fail('Waktu yang dipilih sudah dipesan. Silakan pilih waktu lain.');
                            }
                        }
                    ],
                    'time_to' => 'required|date_format:Y-m-d H:i|after:time_from',
                ];
            }
            default:
                return [];
        }
    }
}
