<?php
namespace App\Http\Requests\Dashboard\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreServiceRequest extends FormRequest
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
            'name'                    => 'required|string|max:255',
            'price'                   => 'required|numeric|min:0',
            'time_slots'              => 'required|array|min:1',
            'time_slots.*.date'       => 'required|date',
            'time_slots.*.start_time' => 'required|date_format:H:i',
            'time_slots.*.end_time'   => 'required|date_format:H:i|after:time_slots.*.start_time',
        ];
    }
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $slots = $this->input('time_slots', []);

            $dates          = collect();
            $dateStartTimes = collect();
            $dateEndTimes   = collect();

            foreach ($slots as $slot) {
                $date  = $slot['date'] ?? '';
                $start = $slot['start_time'] ?? '';
                $end   = $slot['end_time'] ?? '';

                if ($dates->contains($date)) {
                    $validator->errors()->add(
                        'time_slots',
                        __('Duplicate date found: :date', ['date' => $date])
                    );
                    break;
                }
                $dates->push($date);

                $dateStart = $date . '|' . $start;
                if ($dateStartTimes->contains($dateStart)) {
                    $validator->errors()->add(
                        'time_slots',
                        __('Duplicate date and start time found: :date :start', ['date' => $date, 'start' => $start])
                    );
                    break;
                }
                $dateStartTimes->push($dateStart);

                $dateEnd = $date . '|' . $end;
                if ($dateEndTimes->contains($dateEnd)) {
                    $validator->errors()->add(
                        'time_slots',
                        __('Duplicate date and end time found: :date :end', ['date' => $date, 'end' => $end])
                    );
                    break;
                }
                $dateEndTimes->push($dateEnd);
            }
        });
    }

}
