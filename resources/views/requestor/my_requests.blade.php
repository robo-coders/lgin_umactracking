@extends('parent.admin')
@section('body')
@if (session()->has('message'))
<div class="alert alert-success" role="alert">
   <div class="alert-text"> {{session()->get('message')}}</div>
</div>
@endif
@if (session()->has('update'))
<div class="alert alert-success" role="alert">
   <div class="alert-text"> {{session()->get('update')}}</div>
</div>
@endif
@if (session()->has('delete'))
<div class="alert alert-danger" role="alert">
   <div class="alert-text"> {{session()->get('delete')}}</div>
</div>
@endif	
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
   <div class="kt-portlet">
      <div class="kt-portlet__body  kt-portlet__body--fit">
         <div class="row row-no-padding row-col-separator-xl">
            <div class="col-md-12">
               <!--begin:: Requests List -->
               <div class="kt-portlet kt-portlet--height-fluid">
                  <div class="kt-portlet__head">
                     <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                           Request Tickets
                        </h3>
                     </div>
                  </div>
                  <div class="kt-portlet__body">
                     @if(!$requests->isEmpty())
                        @foreach ($requests as $request)
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="kt-widget3">
                                    <div class="kt-widget3__item" style="border-bottom: 1px dashed #c0c3ca;">
                                       <div class="kt-widget3__header">
                                          <div class="col-md-4">
                                             <div class="kt-widget3__info">
                                                <a href="#" class="kt-widget3__username">
                                                   Supervisor Name : {{$request->supervisor_name}}
                                                   </a><br>
                                                   <a href="#" class="kt-widget3__username">
                                                   Request id : {{$request->request_id}}
                                                   </a><br>
                                                   <span class="kt-widget3__time">
                                                   {{$request->created_at->diffForHumans()}}
                                                   </span>
                                             </div>
                                          </div>
                                          
                                          <div class="col-md-3">
                                             <div class="kt-widget3__info">
                                                @foreach ($request->ticketHistory as $history)
                                                   @if($history->flag == '2')
                                                      <a href="#" class="kt-widget3__username">
                                                         Request Assign : {{$history->created_at->toFormattedDateString()}}
                                                      </a>
                                                      <br>
                                                      @elseif($history->flag == '3')
                                                      <a href="#" class="kt-widget3__username">
                                                         Request Complete : {{$history->created_at->toFormattedDateString()}}
                                                      </a>
                                                      <br>
                                                      @elseif($history->flag == '4')
                                                         <span class="kt-widget3__time">
                                                            Request Approved : {{$history->created_at->toFormattedDateString()}}
                                                         </span>
                                                      <br>
                                                   @endif
                                                @endforeach
                                             </div>
                                          </div>
                                          {{-- Status starts --}}
                                          
                                             @if($request->status == '1')
                                                <span class="kt-widget3__status kt-font-info">
                                                   <div class="kt-portlet__head-toolbar">
                                                      <div class="dropdown dropdown-inline">
                                                         <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         <i class="flaticon-more-1"></i>
                                                         </button>
                                                         <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                                            <!--begin::Nav-->
                                                            <ul class="kt-nav">
                                                               <li class="kt-nav__item">
                                                                  <a href="{{ route('viewRequestByRequestor', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                                  <i class="kt-nav__link-icon flaticon-eye"></i>
                                                                  <span class="kt-nav__link-text">View Request</span>
                                                                  </a>
                                                               </li>
                                                               @can('update request')
                                                                  <li class="kt-nav__item">
                                                                     <a href="{{ route('editByRequestor', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                                     <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                                                                     <span class="kt-nav__link-text">Edit</span>
                                                                     </a>
                                                                  </li>
                                                               @endcan
                                                               @can('delete request')
                                                                  <li class="kt-nav__item">
                                                                     <a href="" class="kt-nav__link" data-dell_id="{{$request->id}}" data-toggle="modal" data-target="#requestDeleteByRequestor">
                                                                     <i class="kt-nav__link-icon flaticon2-trash"></i>
                                                                     <span class="kt-nav__link-text">Delete</span>
                                                                     </a>
                                                                  </li>
                                                               @endcan
                                                               
                                                            </ul>
                                                            <!--end::Nav-->
                                                         </div>
                                                         {{'Open'}}		
                                                      </div>
                                                   </div>
                                                </span>
                                             @elseif($request->status == '2')
                                             <span class="kt-widget3__status kt-font-warning">
                                                <div class="kt-portlet__head-toolbar">
                                                   <div class="dropdown dropdown-inline">
                                                      <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                      <i class="flaticon-more-1"></i>
                                                      </button>
                                                      <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                                         <!--begin::Nav-->
                                                         <ul class="kt-nav">
                                                            <li class="kt-nav__item">
                                                               <a href="{{ route('viewRequestByRequestor', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                               <i class="kt-nav__link-icon flaticon-eye"></i>
                                                               <span class="kt-nav__link-text">View Request</span>
                                                               </a>
                                                            </li>
                                                         </ul>
                                                         <!--end::Nav-->
                                                      </div>
                                                      {{'Processing'}}		
                                                   </div>
                                                </div>		
                                             </span>
                                             @elseif($request->status == '3')
                                                <span class="kt-widget3__status kt-font-danger">
                                                   <div class="kt-portlet__head-toolbar">
                                                      <div class="dropdown dropdown-inline">
                                                         <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         <i class="flaticon-more-1"></i>
                                                         </button>
                                                         @can('approve request')
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                                               <!--begin::Nav-->
                                                               <ul class="kt-nav">
                                                                  <li class="kt-nav__item">
                                                                     <a href="{{ route('approveByRequestor', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                                     <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                                                                     <span class="kt-nav__link-text">Approve now</span>
                                                                     </a>
                                                                  </li>
                                                                  <li class="kt-nav__item">
                                                                     <a href="{{ route('viewReviewByRequestor', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                                     <i class="kt-nav__link-icon flaticon-eye"></i>
                                                                     <span class="kt-nav__link-text">Review</span>
                                                                     </a>
                                                                  </li>
                                                                  
                                                               </ul>
                                                               <!--end::Nav-->
                                                            </div>
                                                         @endcan
                                                         {{'Waiting for approval'}}		
                                                      </div>
                                                   </div>
                                                </span>
                                             @elseif($request->status == '4')
                                                <span class="kt-widget3__status kt-font-success">
                                                   <div class="kt-portlet__head-toolbar">
                                                      <div class="dropdown dropdown-inline">
                                                         <button type="button" class="btn btn-clean btn-sm btn-icon-md btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                         <i class="flaticon-more-1"></i>
                                                         </button>
                                                         <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                                                            <!--begin::Nav-->
                                                            <ul class="kt-nav">
                                                               <li class="kt-nav__item">
                                                                  <a href="{{ route('viewRequestByRequestor', ['id'=>$request->id]) }}" class="kt-nav__link">
                                                                  <i class="kt-nav__link-icon flaticon-eye"></i>
                                                                  <span class="kt-nav__link-text">View Request</span>
                                                                  </a>
                                                               </li>
                                                            </ul>
                                                            <!--end::Nav-->
                                                         </div>
                                                            {{'Completed'}}		
                                                      </div>
                                                   </div>
                                                </span>
                                             @endif
                                       {{-- Status ends --}}
                                       </div>
                                       <div class="kt-widget3__body">
                                          <p class="kt-widget3__text">
                                             {{$request->machine_description}}
                                          </p>
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
               <!--end:: Requests List -->
            </div>
            {{-- End Coloum here --}}
         </div>
      </div>
      {{-- End body here --}}
   </div>
</div>
@include('modals.request_delete')
@endsection
