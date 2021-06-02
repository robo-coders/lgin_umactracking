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
@if (count($errors) > 0 )
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
				<div class="danger"> 
					<li> {{$error}}  </li>
				</div>
			@endforeach
		</ul>
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
                        Tasks
                     </h3>
                  </div>
                  <div class="kt-portlet__head-toolbar">
                     <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-brand" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" data-toggle="tab" href="#kt_widget2_tab1_content" role="tab">
                           Open
                           </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" data-toggle="tab" href="#kt_widget2_tab3_content" role="tab">
                           Pending
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="kt-portlet__body">
                  <div class="tab-content">
                     <div class="tab-pane active" id="kt_widget2_tab1_content">
                        <div class="kt-widget2">
                           @if(!$tasks->isEmpty())
                           @foreach ($tasks as $task)
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="kt-widget2__item kt-widget2__item--warning">
                                    <div class="kt-widget2__checkbox">
                                       {{--  --}}
                                    </div>
                                    <div class="col-md-3">
                                       <div class="kt-widget2__info">
                                          <a href="#" class="kt-widget2__title">
                                          {{$task->request_id}} || {{$task->supervisor_name}}
                                          </a>
                                          <a href="#" class="kt-widget2__username">
                                          @if($task->priority_level == '1')
                                          <span class="kt-widget3__status kt-font-brand">
                                          Normal
                                          </span>
                                          @elseif($task->priority_level == '2')
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
                                          Request open
                                          </a>
                                          <a href="#" class="kt-widget2__username">
                                          <span class="kt-widget3__status kt-font-brand">
                                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $task->created_at->toFormattedDateString()}}
                                          </span>
                                          </a>
                                       </div>
                                    </div>
                                    @foreach ($task->ticketHistory as $history)
                                    @if($history->flag == '2')
                                    <div class="col-md-3">
                                       <div class="kt-widget2__info">
                                          <a href="#" class="kt-widget2__title">
                                          Assign Date & Time
                                          </a>
                                          <a href="#" class="kt-widget2__username">
                                          <span class="kt-widget3__status kt-font-brand">
                                          &nbsp;&nbsp;{{ $history->created_at->toFormattedDateString()}} || {{ $history->created_at->format('H:i:s')}}
                                          </span>
                                          </a>
                                       </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <div class="kt-widget2__actions">
                                       <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                       <i class="flaticon-more-1"></i>
                                       </a>
                                       <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                          <ul class="kt-nav">
                                             <li class="kt-nav__item">
                                                <a href="{{ route('viewTicketByTechnician', ['id'=>$task->id]) }}" class="kt-nav__link">
                                                <i class="kt-nav__link-icon flaticon-eye"></i>
                                                <span class="kt-nav__link-text">View Request</span>
                                                </a>
                                             </li>
                                             @can('complete request technician')
                                                <li class="kt-nav__item">
                                                   <a href="{{ route('reviewIndex', ['id'=>$task->id]) }}" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon flaticon2-check-mark"></i>
                                                   <span class="kt-nav__link-text">Complete</span>
                                                   </a>
                                                </li>
                                             @endcan
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
                        {{-- all tab body --}}
                        <div class="tab-pane active" id="kt_widget2_tab1_content">
                            <div class="kt-widget2">
                               @if(!$pendings->isEmpty())
                               @foreach ($pendings as $pending)
                               <div class="row">
                                  <div class="col-md-12">
                                     <div class="kt-widget2__item kt-widget2__item--warning">
                                        <div class="kt-widget2__checkbox">
                                           {{--  --}}
                                        </div>
                                        <div class="col-md-3">
                                           <div class="kt-widget2__info">
                                              <a href="#" class="kt-widget2__title">
                                              {{$pending->request_id}} || {{$pending->supervisor_name}}
                                              </a>
                                              <a href="#" class="kt-widget2__username">
                                              @if($pending->priority_level == '1')
                                              <span class="kt-widget3__status kt-font-brand">
                                              Normal
                                              </span>
                                              @elseif($pending->priority_level == '2')
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
                                              Request open
                                              </a>
                                              <a href="#" class="kt-widget2__username">
                                              <span class="kt-widget3__status kt-font-brand">
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $pending->created_at->toFormattedDateString()}}
                                              </span>
                                              </a>
                                           </div>
                                        </div>
                                        @foreach ($pending->ticketHistory as $history)
                                            @if($history->flag == '2')
                                                <div class="col-md-2">
                                                    <div class="kt-widget2__info">
                                                        <a href="#" class="kt-widget2__title">
                                                        Assign Date & Time
                                                        </a>
                                                        <a href="#" class="kt-widget2__username">
                                                        <span class="kt-widget3__status kt-font-brand">
                                                        &nbsp;&nbsp;{{ $history->created_at->toFormattedDateString()}} || {{ $history->created_at->format('H:i:s')}}
                                                        </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                @elseif($history->flag == '3')
                                                <div class="col-md-3">
                                                    <div class="kt-widget2__info">
                                                        <a href="#" class="kt-widget2__title">
                                                        Complete Date & Time
                                                        </a>
                                                        <a href="#" class="kt-widget2__username">
                                                        <span class="kt-widget3__status kt-font-brand">
                                                        &nbsp;&nbsp;{{ $history->created_at->toFormattedDateString()}} || {{ $history->created_at->format('H:i:s')}}
                                                        </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div class="kt-widget2__actions">
                                           <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                           <i class="flaticon-more-1"></i>
                                           </a>
                                           <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                              <ul class="kt-nav">
                                                <li class="kt-nav__item">
                                                   <a href="{{ route('viewTicketByTechnician', ['id'=>$pending->id]) }}" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon flaticon-eye"></i>
                                                   <span class="kt-nav__link-text">Request</span>
                                                   </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                   <a href="{{ route('viewReviewByTechnician', ['id'=>$pending->id]) }}" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon flaticon-eye"></i>
                                                   <span class="kt-nav__link-text">Review</span>
                                                   </a>
                                                </li>
                                                <li class="kt-nav__item">
                                                   <a href="{{ route('editTicketReviewByTechnician', ['id'=>$pending->id]) }}" class="kt-nav__link">
                                                   <i class="kt-nav__link-icon la la-edit"></i>
                                                   <span class="kt-nav__link-text">Edit Review</span>
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