<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Service\StoreServiceRequest;
use App\Models\Service;
use App\Services\Dashboard\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ServiceController extends Controller
{
    public function __construct(public ServiceService $serviceService)
    {}
    public function index(Request $request)
    {
        $services = $this->serviceService->index();
        return view('dashboard.pages.services.index', compact('services'));
    }
    public function create()
    {
        return view('dashboard.pages.services.create');
    }

    public function store(StoreServiceRequest $storeServiceRequest)
    {
        $data = $storeServiceRequest->validated();
        $this->serviceService->store($data);
        Session::flash('message', ['type' => 'success', 'text' => __('Service created successfully')]);
        return redirect()->route('Admin.services.index');
    }

    public function show(Service $service)
    {
        return view('dashboard.pages.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('dashboard.pages.services.edit', compact('service'));
    }

    public function update(Service $service, StoreServiceRequest $storeServiceRequest)
    {

        $data = $storeServiceRequest->validated();
        $this->serviceService->update($service, $data);
        Session::flash('message', ['type' => 'success', 'text' => __('Service updated successfully')]);
        return redirect()->route('Admin.services.index');
    }

    public function destroy(Service $service)
    {
        $this->serviceService->destroy($service);

        return redirect()->route('Admin.services.index')->with('success', 'Service Successfully.');
    }

    public function restore(string $id)
    {
        $this->serviceService->restore($id);

        return redirect()->route('Admin.services.index')->with('success', 'Service Successfully.');
    }

    public function forceDelete(string $id)
    {
        $this->serviceService->forceDelete($id);

        return redirect()->route('Admin.services.index')->with('success', 'Service Successfully.');
    }

}
