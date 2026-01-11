<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Dashboard\HomeService;

class HomeController extends Controller
{
    public function __construct(protected HomeService $statisticsService) {}

    public function index()
    {
        $data = $this->statisticsService->getStatistics();

        return view('dashboard.pages.home', $data);
    }
}
