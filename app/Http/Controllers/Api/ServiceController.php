<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\Api\ServiceService;
use App\Traits\HttpResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HttpResponse, AuthorizesRequests;
    public function __construct(public ServiceService $serviceService)
    {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Service::class);
        $services = $this->serviceService->index();
        return $this->paginatedResponse($services, ServiceResource::class);
    }

}
