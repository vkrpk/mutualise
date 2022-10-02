<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function serviceUpdate(Request $request, Service $service)
    {
        $services = Service::all()->toArray();
   
        foreach ($services as $service) {
            foreach ($request->service as $inputService => $value) {
                if ($service['name'] === $inputService) {
                    if ($service['is_active'] != $value) {
                        DB::table('services')->where('name', $service["name"])
                            ->update([
                                'is_active' => $value,
                                'updated_at' => now()
                            ]);
                    }
                }
            }
        }

        return back()->with('status', 'Les changements ont bien été pris en compte');
    }
}
