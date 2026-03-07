<?php

namespace App\Location\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Location\Services\LocationService;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct(private LocationService $locationService)
    {
    }
}
