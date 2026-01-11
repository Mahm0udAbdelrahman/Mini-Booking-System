@extends('dashboard.layouts.app')
@section('title', __('Edit Service'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">{{ __('Edit Service') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.services.index') }}">{{ __('Service') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Edit Service') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <form method="post" action="{{ route('Admin.services.update', $service->id) }}"
                        enctype="multipart/form-data" class="p-3 rounded shadow-lg bg-white">
                        @csrf
                        @method('PUT')

                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 class="mb-0">{{ __('Edit Service') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">


                                    <div class="col-md-6">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $service->name) }}"
                                            placeholder="{{ __('Enter the  name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price" class="form-label">{{ __('Price') }}</label>
                                        <input type="price" name="price" id="price" class="form-control"
                                            value="{{ old('price', $service->price) }}"
                                            placeholder="{{ __('Enter the service price') }}">
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Time Slots -->
                                    <div id="timeSlotsWrapper">
                                        <label class="form-label">{{ __('Time Slots') }}</label>
                                        @error('time_slots')
                                            <small class="text-danger d-block mb-2">{{ $message }}</small>
                                        @enderror

                                        @foreach ($errors->get('time_slots.*.date') as $messages)
                                            @foreach ($messages as $message)
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @endforeach
                                        @endforeach

                                        @foreach ($errors->get('time_slots.*.start_time') as $messages)
                                            @foreach ($messages as $message)
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @endforeach
                                        @endforeach

                                        @foreach ($errors->get('time_slots.*.end_time') as $messages)
                                            @foreach ($messages as $message)
                                                <small class="text-danger d-block">{{ $message }}</small>
                                            @endforeach
                                        @endforeach

                                        @foreach (old('time_slots', $service->timeSlots->toArray()) as $index => $slot)
                                            <div class="time-slot mb-3">
                                                <input type="hidden" name="time_slots[{{ $index }}][id]"
                                                    value="{{ $slot['id'] ?? '' }}">

                                                <input type="date" name="time_slots[{{ $index }}][date]"
                                                    class="form-control mb-2"
                                                    value="{{ old("time_slots.$index.date", $slot['date'] ?? '') }}"
                                                    required>
                                                <input type="time" name="time_slots[{{ $index }}][start_time]"
                                                    class="form-control mb-2"
                                                    value="{{ old("time_slots.$index.start_time", $slot['start_time'] ?? '') }}"
                                                    required>
                                                <input type="time" name="time_slots[{{ $index }}][end_time]"
                                                    class="form-control mb-2"
                                                    value="{{ old("time_slots.$index.end_time", $slot['end_time'] ?? '') }}"
                                                    required>
                                                <button type="button" class="btn btn-danger btn-sm removeTimeSlot">-
                                                    {{ __('Remove') }}</button>
                                            </div>
                                        @endforeach

                                    </div>

                                    <button type="button" id="addTimeSlot" class="btn btn-secondary mb-3">+
                                        {{ __('Add Time Slot') }}</button>



                                </div>
                            </div>
                            <div class="card-footer text-end bg-light rounded-bottom">
                                <button type="submit" class="btn btn-primary px-4">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let slotIndex = {{ count(old('time_slots', $service->timeSlots)) }};

        document.getElementById('addTimeSlot').addEventListener('click', function() {
            const wrapper = document.getElementById('timeSlotsWrapper');

            const slotDiv = document.createElement('div');
            slotDiv.classList.add('time-slot', 'mb-3');

            slotDiv.innerHTML = `
            <input type="hidden" name="time_slots[${slotIndex}][id]" value="">
            <input type="date" name="time_slots[${slotIndex}][date]" class="form-control mb-2" required>
            <input type="time" name="time_slots[${slotIndex}][start_time]" class="form-control mb-2" required>
            <input type="time" name="time_slots[${slotIndex}][end_time]" class="form-control mb-2" required>
            <button type="button" class="btn btn-danger btn-sm removeTimeSlot">- {{ __('Remove') }}</button>
        `;

            wrapper.appendChild(slotDiv);

            slotDiv.querySelector('.removeTimeSlot').addEventListener('click', function() {
                slotDiv.remove();
            });

            slotIndex++;
        });

        document.querySelectorAll('.removeTimeSlot').forEach(btn => {
            btn.addEventListener('click', function() {
                btn.parentElement.remove();
            });
        });
    </script>
@endpush
