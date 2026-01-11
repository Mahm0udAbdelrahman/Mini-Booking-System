@extends('dashboard.layouts.app')
@section('title', __('Show Booking'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">{{ __('Show Booking') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.booking.index') }}">{{ __('Booking') }}</a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Show Booking') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="p-3 rounded shadow-lg bg-white">

                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 class="mb-0">{{ __('Show Booking') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Name') }}</label>
                                        <div class="form-control-plaintext">{{ $booking->user->name }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Price') }}</label>
                                        <div class="form-control-plaintext">{{ $booking->price }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Service') }}</label>
                                        <div class="form-control-plaintext">{{ $booking->service->name }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Date') }}</label>
                                        <div class="form-control-plaintext">{{ $booking->slot->date }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Start Time') }}</label>
                                        <div class="form-control-plaintext">{{ $booking->slot->start_time }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('End Time') }}</label>
                                        <div class="form-control-plaintext">{{ $booking->slot->end_time }}</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">{{ __('Status') }}</label>
                                        <div class="form-control-plaintext text-capitalize">{{ $booking->status }}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer bg-light rounded-bottom text-end">
                                <a href="{{ route('Admin.booking.index') }}" class="btn btn-secondary px-4">
                                    {{ __('Back') }}
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
