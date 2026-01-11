<?php
namespace App\Services\Api;

use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Support\Facades\DB;

class ServiceService
{
    public function __construct(public Service $model)
    {}

    public function index()
    {
        return $this->model->paginate();
    }


}
