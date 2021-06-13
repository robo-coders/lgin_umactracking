<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\manifest;
use fmRESTor\fmRESTor;
use Illuminate\Support\Facades\DB;
use App\Rule\PrefixRule;

class manifestController extends Controller
{
    public function search(Request $request)
    {


        // $fm = new fmRESTor("fms.umacbox.info", "uph_sys_dev", "dapi-manifest", "dapi", "webaccess@fm181");
        $fm = new fmRESTor("fms.umacbox.info", "uph_sys_dev", "dapi-manifest", "dapi", "webaccess@fm181");





        // $parameters = array(
        //     "_limit"=>5
        // );
        //  $resp = $fm->getRecords($parameters);

        $request->validate([
            "boxno"     =>  ["required", new PrefixRule()]
        ]);

        
        $records = [];
        $final_records = [];
        $recordIds = [];
        $records_1 = [];
        $records_2 = [];

        $parameters = array(
            "query" => array(
                array(
                    "InvoiceNum" => $request->boxno,
                    //"ConsLast" => $request->lname
                )
            )
        );
        $resp = $fm->findRecords($parameters);
        $rslt_count = count($resp["result"]["response"]);
        if($rslt_count > 0){
            $records_1 = $resp["result"]["response"]["data"];
        }


        $parameters = array(
            "query" => array(
                array(
                    "InvoiceNum" => $request->boxno,
                    //"Manifest_Customers::LastName" => $request->lname
                )
            )
        );
        $resp = $fm->findRecords($parameters);
        $rslt_count = count($resp["result"]["response"]);
        if($rslt_count > 0){
            $records_2 = $resp["result"]["response"]["data"];
        }


        $records = array_merge($records_1, $records_2);

        foreach($records as $rcd){
            if(!in_array($rcd["recordId"], $recordIds)){
                $recordIds[] = $rcd["recordId"];
                $final_records[] = $rcd["fieldData"];
            }
            
        }
        


        // echo "<pre>";
        // print_r($final_records);
        // exit;


        $views =  array_map(function($rcd){


            if($rcd["Manifest_ABLDRLine::DateDelivered"] == "0000-00-00" || $rcd["Manifest_ABLDRLine::DateDelivered"] == ""){
                unset($rcd["Manifest_ABLDRLine::DateDelivered"]);
            }else{
                $rcd["DateDelivered"] = $rcd["Manifest_ABLDRLine::DateDelivered"];
            }
            if($rcd["DateDepUnitWH"] == "0000-00-00" || $rcd["DateDepUnitWH"] == ""){
                unset($rcd["DateDepUnitWH"]);
            }
            if($rcd["DateArvlPortOrigin"] == "0000-00-00" || $rcd["DateArvlPortOrigin"] == ""){
                unset($rcd["DateArvlPortOrigin"]);
            }
            if($rcd["DateShipped"] == "0000-00-00" || $rcd["DateShipped"] == ""){
                unset($rcd["DateShipped"]);
            }
            if($rcd["DateETA"] == "0000-00-00" || $rcd["DateETA"] == ""){
                unset($rcd["DateETA"]);
            }
            if($rcd["DateArrived"] == "0000-00-00" || $rcd["DateArrived"] == ""){
                unset($rcd["DateArrived"]);
            }
            if($rcd["DateActDischarge"] == "0000-00-00" || $rcd["DateActDischarge"] == ""){
                unset($rcd["DateActDischarge"]);
            }
            if($rcd["DateReleased"] == "0000-00-00" || $rcd["DateReleased"] == ""){
                unset($rcd["DateReleased"]);
            }
            if($rcd["DateUnloaded"] == "0000-00-00" || $rcd["DateUnloaded"] == ""){
                unset($rcd["DateUnloaded"]);
            }
            if($rcd["DateETAVismin"] == "0000-00-00" || $rcd["DateETAVismin"] == ""){
                unset($rcd["DateETAVismin"]);
            }
            if($rcd["DateVisminArvl"] == "0000-00-00" || $rcd["DateVisminArvl"] == ""){
                unset($rcd["DateVisminArvl"]);
            }
            if($rcd["Manifest_ABLDRLine::OutForDelivDate"] == "0000-00-00" || $rcd["Manifest_ABLDRLine::OutForDelivDate"] == ""){
                unset($rcd["Manifest_ABLDRLine::OutForDelivDate"]);
            }else{
                $rcd["OutForDelivDate"] = $rcd["Manifest_ABLDRLine::OutForDelivDate"];
            }

            return (object) $rcd;

        }, $final_records);


        return view('manifest.response',compact('views'));


    }





    public function search_backup(Request $request)
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




        // $views = collect($views)->map(function ($view, $key) {
        //     if($view->DateOutForDelivery == "0000-00-00")
        //     unset($view->DateOutForDelivery);
        //     return $view;
        // });
        
        $views->all();
        // return $views;

        
        return view('manifest.response',compact('views'));

        // if(manifest::where('InvoiceNum',$request->InvoiceNum)){
        //     return 'working';
        // } else {
        //     return ' not working';
        // }
    }
    
    public function test()
    {
        $views = manifest::all();
        return $views;
    }
    
}
