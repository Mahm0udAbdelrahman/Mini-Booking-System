@extends('dashboard.layouts.app')
@section('title', __('Edit Booking'))

@section('content')
    <div class="pc-container">
        <div class="pc-content">

            <!-- Page Header -->
            <div class="page-header">
                <div class="page-block">
                    <div class="page-header-title">
                        <h5 class="mb-0 font-medium">{{ __('Edit Booking') }}</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('Admin.home') }}">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('Admin.booking.index') }}">{{ __('Booking') }}</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">{{ __('Edit Booking') }}</li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row mb-5">
                <div class="col-12">
                    <form method="post" action="{{ route('Admin.booking.update', $booking->id) }}"
                        enctype="multipart/form-data" class="p-3 rounded shadow-lg bg-white">
                        @csrf
                        @method('PUT')

                        <div class="card border-0">
                            <div class="card-header bg-primary text-white rounded-top">
                                <h5 class="mb-0">{{ __('Edit Booking') }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">


                                    <div class="col-md-6">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ old('name', $booking->user->name) }}"
                                            placeholder="{{ __('Enter the  name') }}">
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="price" class="form-label">{{ __('Price') }}</label>
                                        <input type="price" name="price" id="price" class="form-control"
                                            value="{{ old('price', $booking->price) }}"
                                            placeholder="{{ __('Enter the booking price') }}">
                                        @error('price')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="service" class="form-label">{{ __('service') }}</label>
                                        <input type="service" name="service" id="service" class="form-control"
                                            value="{{ old('service', $booking->service->name) }}"
                                            placeholder="{{ __('Enter the booking service') }}">
                                        @error('service')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="service" class="form-label">{{ __('service') }}</label>
                                        <input type="service" name="service" id="service" class="form-control"
                                            value="{{ old('service', $booking->service->name) }}"
                                            placeholder="{{ __('Enter the booking service') }}">
                                        @error('service')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="date" class="form-label">{{ __('date') }}</label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            value="{{ old('date', $booking->slot->date) }}"
                                            placeholder="{{ __('Enter the booking date') }}">
                                        @error('date')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="start_time" class="form-label">{{ __('start_time') }}</label>
                                        <input type="time" name="start_time" id="start_time" class="form-control"
                                            value="{{ old('start_time', $booking->slot->start_time) }}"
                                            placeholder="{{ __('Enter the booking start_time') }}">
                                        @error('start_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>


                                    <div class="col-md-6">
                                        <label for="end_time" class="form-label">{{ __('end_time') }}</label>
                                        <input type="time" name="end_time" id="end_time" class="form-control"
                                            value="{{ old('end_time', $booking->slot->end_time) }}"
                                            placeholder="{{ __('Enter the booking end_time') }}">
                                        @error('end_time')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="status" class="form-label">{{ __('Status') }}</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value=""
                                                {{ old('status', $booking->status) === null ? 'selected' : '' }}>
                                                {{ __('Choose status...') }}
                                            </option>
                                            <option value="pending"
                                                {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>
                                                {{ __('Pending') }}
                                            </option>
                                            <option value="confirmed"
                                                {{ old('status', $booking->status) === 'confirmed' ? 'selected' : '' }}>
                                                {{ __('Confirmed') }}
                                            </option>
                                            <option value="cancelled"
                                                {{ old('status', $booking->status) === 'cancelled' ? 'selected' : '' }}>
                                                {{ __('Cancelled') }}
                                            </option>
                                        </select>
                                        @error('status')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>




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
