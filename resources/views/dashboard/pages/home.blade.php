@extends('dashboard.layouts.app')
@section('title', 'Home')
@section('content')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <!-- ...breadcrumb code... -->
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="grid grid-cols-12 gap-x-6">
                <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header !pb-0 !border-b-0">
                            <h5>Daily Sales</h5>
                        </div>
                        <div class="card-body">
                            <div class="flex items-center justify-between gap-3 flex-wrap">
                                <h3 class="font-light flex items-center mb-0">

                                    $ {{ number_format($dailyRevenue, 2) }}
                                </h3>
                                <p class="mb-0">
                                    +{{ $totalConfirmed> 0 ? round(($dailyRevenue / $totalConfirmed) * 100, 2) : 0 }}%

                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header !pb-0 !border-b-0">
                            <h5>Monthly Sales</h5>
                        </div>
                        <div class="card-body">
                            <div class="flex items-center justify-between gap-3 flex-wrap">
                                <h3 class="font-light flex items-center mb-0">

                                    $ {{ number_format($monthlyRevenue, 2) }}
                                </h3>
                                <p class="mb-0">
                                    +{{ $totalConfirmed? round(($monthlyRevenue / $totalConfirmed) * 100, 2) : 0 }}%</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-4">
                    <div class="card">
                        <div class="card-header !pb-0 !border-b-0">
                            <h5>Yearly Sales</h5>
                        </div>
                        <div class="card-body">
                            <div class="flex items-center justify-between gap-3 flex-wrap">
                                <h3 class="font-light flex items-center mb-0">

                                    $ {{ number_format($yearlyRevenue, 2) }}
                                </h3>
                                <p class="mb-0">+{{ $totalConfirmed? round(($yearlyRevenue / $totalConfirmed) * 100, 2) : 0 }}%</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Total Bookings</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-[28px] font-bold">{{ $totalBookings }}</h3>
                        </div>
                    </div>
                </div>


                <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Total</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-[28px] font-bold">${{ number_format($total, 2) }}</h3>
                        </div>
                    </div>
                </div>



                <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Confirmed Revenue</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-[28px] font-bold">${{ number_format($totalConfirmed, 2) }}</h3>
                        </div>
                    </div>
                </div>



                <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Pending Revenue</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-[28px] font-bold">${{ number_format($totalPending, 2) }}</h3>
                        </div>
                    </div>
                </div>

                 <div class="col-span-12 xl:col-span-4 md:col-span-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>cancelled Revenue</h5>
                        </div>
                        <div class="card-body">
                            <h3 class="text-center text-[28px] font-bold">${{ number_format($totalCancelled, 2) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 xl:col-span-4 md:col-span-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Bookings by Status</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Pending: {{ $bookingsByStatus['pending'] ?? 0 }}</li>
                                <li>Confirmed: {{ $bookingsByStatus['confirmed'] ?? 0 }}</li>
                                <li>Cancelled: {{ $bookingsByStatus['cancelled'] ?? 0 }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- [ Main Content ] end -->

        </div>
    </div>
@endsection
