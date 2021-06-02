<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\manifest;
use Illuminate\Support\Facades\DB;
class manifestController extends Controller
{
    public function search(Request $request)
    {
        $views = manifest::where(function ($query) use ($request) {
            $query->where('InvoiceNum',$request->boxno);
        })->where(function ($query) use ($request) {
            $query->where('S_Last',$request->lname)
                  ->orWhere('C_Last',$request->lname);
        })
        ->get();
        $views = collect($views)->map(function ($view, $key) {
            if($view->DateOutForDelivery == "0000-00-00")
            unset($view->DateOutForDelivery);
            
            if($view->PWh_ETA == "0000-00-00")
            unset($view->PWh_ETA);
            
            if($view->PWh_Arrival == "0000-00-00")
            unset($view->PWh_Arrival);

            if($view->DateDelivered == "0000-00-00")
            unset($view->DateDelivered);

            if($view->DateDepUnitWH == "0000-00-00")
            unset($view->DateDepUnitWH);

            if($view->DateArvPortOrigin == "0000-00-00")
            unset($view->DateArvPortOrigin);

            if($view->DateShipped == "0000-00-00")
            unset($view->DateShipped);

            if($view->DateETA == "0000-00-00")
            unset($view->DateETA);

            if($view->DateArrived == "0000-00-00")
            unset($view->DateArrived);

            if($view->DateReleased == "0000-00-00")
            unset($view->DateReleased);

            if($view->DateUnloaded == "0000-00-00")
            unset($view->DateUnloaded);

            return $view;
        });
        $views->all();

        
        return view('manifest.response',compact('views'));
    }
    
    public function test()
    {
        $views = manifest::all();
        return $views;
    }
    
}
