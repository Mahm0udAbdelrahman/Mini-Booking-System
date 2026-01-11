@extends('dashboard.layouts.app')
@section('title', __('Service Details'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">{{ __('Service Details') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.services.index') }}">{{ __('Service') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Service Details') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="p-3 rounded shadow-lg bg-white">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 class="mb-0">{{ __('Service Details') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Name') }}</label>
                                        <p>{{ $service->name }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Price') }}</label>
                                        <p>{{ $service->price }}</p>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold">{{ __('Time Slots') }}</label>
                                        @if ($service->timeSlots && $service->timeSlots->count())
                                            <div>
                                                @foreach ($service->timeSlots as $slot)
                                                    <div class="mb-3 p-3 border rounded">
                                                        <p><strong>{{ __('Date') }}:</strong>
                                                            {{ \Carbon\Carbon::parse($slot->date)->format('Y-m-d') }}</p>
                                                        <p><strong>{{ __('Start Time') }}:</strong>
                                                            {{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }}
                                                        </p>
                                                        <p><strong>{{ __('End Time') }}:</strong>
                                                            {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}</p>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>{{ __('No time slots available') }}</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-end bg-light rounded-bottom">
                                <a href="{{ route('Admin.services.index') }}"
                                    class="btn btn-secondary px-4">{{ __('Back') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
