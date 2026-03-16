<?php

namespace App\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Location\Dto\CreateLocationDTO;
use App\Location\Dto\UpdateLocationDTO;
use App\Location\Http\Resources\LocationResource;
use App\Location\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(private LocationService $locationService)
    {
    }

    public function index(): ApiResponse
    {
        return new ApiResponse($this->locationService->getAllLocations()->toResourceCollection());
    }

    public function store(Request $request)
    {
        return $this->locationService->createLocation(CreateLocationDTO::from($request->all()));
    }

    public function show($id)
    {
        return $this->locationService->getLocation($id);
    }

    public function update(Request $request, $id)
    {
        return $this->locationService->updateLocation(UpdateLocationDTO::from(['id' => $id] + $request->all()));
    }

    public function destroy($id)
    {
        return $this->locationService->deleteLocation($id);
    }
}
