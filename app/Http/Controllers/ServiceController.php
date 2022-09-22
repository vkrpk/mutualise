<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function serviceUpdate(Request $request, Service $service)
    {
        $services = Service::all();
        foreach ($services as $service) {
            $service->update(['is_active' => false]);
        }
        if(isset($request->service) ){
            foreach ($request->service as $inputService => $value) {
                if ($value == 'on') {
                    $service = Service::where('name', $inputService)
                        ->update(['is_active' => true]);
                }
            }
        }

        return back()->with('status', 'Les changements ont bien été pris en compte');
    }
}
