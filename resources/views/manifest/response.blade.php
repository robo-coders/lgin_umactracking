@extends('frontend.app')
@section('body')
<div class="transportaion_area">
   <div class="container">

      {{-- @if(isset($views)) --}}
      @if(isset($views) && count($views)>0)
      <div class="row">
         <div class="col-md-12">
            @foreach ($views as $view)
                <h3 align="center"> {{$view->InvoiceNum}}</h3>
                <p align="center"> {{$view->CtrlNumUS}}</p>
                @if(isset($view->DateDelivered))
                    <div class="d-flex justify-content-center">
                    <img src="{{asset('frontend/img/check.jpg')}}" width="80px" height="65px" alt="Done">
                    </div>
                    <p align="center" style="font-size:17px;letter-spacing:2px;">Delivered</p>
                    <p class="negative-pedding" align="center">{{$view->DateDelivered}}</p>
                    <p align="center">Received by: {{$view->RcvdBy}}</p>
                @endif
                <div class="row justify-content-between" style="width:80%;margin:0 auto;">
                    <div class="col-md-3">
                        <h4 class="">From</h4>
                        <p class="mb-1"> {{$view->CustName}}</p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="">To</h4>
                        <p class="mb-1"> {{$view->ConsName}}</p>
                        <p class="mb-1"> {{$view->ConsAddr2}}</p>
                    </div>
               @endforeach
            </div>
            <div class="row" id="scroll">
               <div class="col-md-12">
                  <div style="width:80%;margin:0 auto;">
                     @foreach ($views as $view)
                     <table class="table table-striped" style="table-layout: fixed ;">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col" style="width:20%;">Date</th>
                              <th scope="col" style="width:80%;">Activity</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if(isset($view->DateDepUnitWH))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateDepUnitWH}} --}}
                                 {{ date("d M, Y",strtotime($view->DateDepUnitWH)) }}
                              </td>
                              <td>
                              Container departed from Origin warehouse
                              {{-- Container departed from Origin warehouse {{$view->PortOfOrigin}}  --}}
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateArvlPortOrigin))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateArvPortOrigin}} --}}
                                 {{ date("d M, Y",strtotime($view->DateArvlPortOrigin)) }}
                              </td>
                              <td>
                                 Container arrived at port of loading
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateShipped))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateShipped}} --}}
                                 {{ date("d M, Y",strtotime($view->DateShipped)) }}
                              </td>
                              <td>
                                 Shipping vessel departed from port of loading
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateETA))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateETA}} --}}
                                 {{ date("d M, Y",strtotime($view->DateETA)) }}
                              </td>
                              <td>
                                 Shipping vessel estimated date of arrival at Philippine port
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateArrived))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateArrived}} --}}
                                 {{ date("d M, Y",strtotime($view->DateArrived)) }}
                              </td>
                              <td>
                                 Shipping vessel arrived at Manila port area and awaiting to dock
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateActDischarge))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateActDischarge}} --}}
                                 {{ date("d M, Y",strtotime($view->DateActDischarge)) }}
                              </td>
                              <td>
                                 Container off-loaded from shipping vessel
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateReleased))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateReleased}} --}}
                                 {{ date("d M, Y",strtotime($view->DateReleased)) }}
                              </td>
                              <td>
                                 Container released from Philippine Customs & for transport to Marikina Warehouse
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateUnloaded))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateUnloaded}} --}}
                                 {{ date("d M, Y",strtotime($view->DateUnloaded)) }}
                              </td>
                              <td>
                                 Unloaded from the container at Marikina Warehouse
                              </td>
                           </tr>
                           @endif


                           @if(strtolower($view->HighlightStatus) == "disp")
                              @if(isset($view->OutForDelivDate))
                                <tr>
                                    <td scope="row">
                                        {{ date("d M, Y",strtotime($view->OutForDelivDate)) }}
                                    </td>
                                    <td>
                                    Dispatch to provincial warehouse
                                    </td>
                                </tr>
                              @endif
                           @endif
                           
                           @if(isset($view->DateETAVismin))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateETAVismin}} --}}
                                 {{ date("d M, Y",strtotime($view->DateETAVismin)) }}
                              </td>
                              <td>
                                 Estimated Arrival at Provincial Warehouse
                              </td>
                           </tr>
                           @endif
                           @if(isset($view->DateVisminArvl))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateVisminArvl}} --}}
                                 {{ date("d M, Y",strtotime($view->DateVisminArvl)) }}
                              </td>
                              <td>
                                 Arrived at Provincial warehouse
                              </td>
                           </tr>
                           @endif    




                        @php /*
                           @if(strtolower($view->HighlightStatus) == "ofd")@endif
                           */
                        @endphp
                           @if(isset($view->OutForDelivDate))
                                <tr>
                                    <td scope="row">
                                        {{ date("d M, Y",strtotime($view->OutForDelivDate)) }}
                                    </td>
                                    <td>
                                    @if(isset($view->DateETAVismin))
                                       Dispatch to Provincial Warehouse
                                    @else
                                       Out for delivery
                                    @endif
                                    </td>
                                </tr>
                              @endif

                           @if(strtolower($view->HighlightStatus) == "rb")
                              @if(isset($view->OutForDelivDate))
                                <tr>
                                    <td scope="row">
                                        {{ date("d M, Y",strtotime($view->OutForDelivDate)) }}
                                    </td>
                                    <td>
                                    Delivery attempted - rearrange delivery
                                    </td>
                                </tr>
                              @endif
                           @endif



                           @if(isset($view->DateDelivered))
                           <tr>
                              <td scope="row">
                                 {{-- {{$view->DateDelivered->toFormattedDateString()}} --}}
                                 {{ date("d M, Y",strtotime($view->DateDelivered)) }}
                              </td>
                              <td>
                                 Delivered
                              </td>
                           </tr>
                           @endif    
                        </tbody>
                     </table>
                     @endforeach
                  </div>
               </div>
            </div>
         </div>
      </div>
      @else 
      <div class="row">
         <div class="col-md-12 transportaion_area_content text-center">
            {{-- 
            <h1 class="error" style=""> Error!</h1>
            --}}
            <h3 class="" style="color:#fc0509"> Shipping details unavailable</h3>
            <p style="font-size:20px;letter-spacing:4px;" > Possible reason/s:</p>
             <p style="font-size:20px;letter-spacing:4px;" > - Shipping details have not yet submitted.</p>
              <p style="font-size:20px;letter-spacing:4px;" > - Box number and/or lastname incorrect .</p>
         </div>
      </div>
      @endif
   </div>
</div>
@endsection