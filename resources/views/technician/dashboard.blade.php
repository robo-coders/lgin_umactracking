@extends('parent.admin')
@section('body')
@if (session()->has('message'))
<div class="alert alert-success" role="alert">
   <div class="alert-text"> {{session()->get('message')}}</div>
</div>
@endif
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
   <div class="kt-portlet">
      <!--Begin::Section-->
      <div class="row">
         <div class="col-xl-12">
            <!--begin:: Widgets/Tasks -->
            <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <h3 class="kt-portlet__head-title">
                        Requests
                     </h3>
                  </div>
                  <div class="kt-portlet__head-toolbar">
                     <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab">
                           Today
                           </a>
                        </li>
                        {{-- <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab3_content" role="tab">
                           All
                           </a>
                        </li> --}}
                     </ul>
                  </div>
               </div>
               <div class="kt-portlet__body">
                  <div class="tab-content">
                     <div class="tab-pane active" id="kt_widget2_tab1_content">
                        <div class="kt-widget2">
                           @if(!$tickets->isEmpty())
                              @foreach ($tickets as $ticket)
                              <div class="row" >
                                 <div class="col-md-12" >
                                    <div class="kt-widget2__item kt-widget2__item--brand">
                                       <div class="kt-widget2__checkbox">
                                             {{--  --}}
                                       </div>
                                          <div class="col-md-3">
                                             <div class="kt-widget2__info">
                                                <a href="#" class="kt-widget2__title">
                                                {{$ticket->request_id}} || {{$ticket->supervisor_name}}
                                                </a>
                                                <a href="#" class="kt-widget2__username">
                                                @if($ticket->priority_level == '1')
                                                <span class="kt-widget3__status kt-font-brand">
                                                Normal
                                                </span>
                                                @elseif($ticket->priority_level == '2')
                                                <span class="kt-widget3__status kt-font-danger">
                                                High
                                                </span>
                                                @endif
                                                </a>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="kt-widget2__info">
                                                <a href="#" class="kt-widget2__title">
                                                Requestor: {{ $ticket->requestor->name}}
                                                </a>
                                                <a href="#" class="kt-widget2__username">
                                                   <span class="kt-widget3__status kt-font-brand">
                                                      {{$ticket->requestor->email}}
                                                   </span>
                                                </a>
                                             </div>
                                          </div>
                                          <div class="col-md-3">
                                             <div class="kt-widget2__info">
                                                <a href="#" class="kt-widget2__title">
                                                   Request open
                                                   </a>
                                                   <a href="#" class="kt-widget2__username">
                                                      <span class="kt-widget3__status kt-font-brand">
                                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $ticket->created_at->toFormattedDateString()}}
                                                      </span>
                                                   </a>
                                             </div>
                                          </div>
                                       <div class="kt-widget2__actions">
                                             <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                             <i class="flaticon-more-1"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                                <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                   <a href="{{ route('viewTicketByTechnician', ['id'=>$ticket->id]) }}" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon flaticon-eye"></i>
                                                   <span class="kt-nav__link-text">View Request</span>
                                                   </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                   <a href="{{ route('assignTicketToTechnician', ['id'=>$ticket->id]) }}" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon flaticon-refresh"></i>
                                                   <span class="kt-nav__link-text">Assign me</span>
                                                   </a>
                                                </li>
                                                </ul>
                                          </div>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           @else 
                            {{-- Null Row Start --}}
                            <div class="col-md-12 text-danger">
                                <h5 class="text-center"> No record Found</h5>
                            </div>
                            {{-- Null row ends --}}
                           @endif
                        </div>
                     </div>
                     {{-- Today Tab Ends --}}
                     <div class="tab-pane" id="kt_widget2_tab3_content">
                        {{-- second : All Tab --}}
                     </div>
                  </div>
               </div>
            </div>
            <!--end:: Widgets/Tasks -->
         </div>
      </div>
      <!--End::Section-->
   </div>
</div>
@endsection