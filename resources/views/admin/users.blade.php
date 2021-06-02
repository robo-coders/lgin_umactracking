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
   <div class="row">
      <div class="col-xl-12">
         <!--begin::Portlet-->
         <div class="kt-portlet">
            <div class="kt-portlet__head">
               <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title">
                     Users List
                  </h3>
               </div>
            </div>
            <div class="kt-portlet__body">
               <!--begin::Section-->
               <div class="kt-section">
                  <div class="kt-section__content">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Avatar</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Address</th>
                              <th>Contact</th>
                              <th>Email</th>
                              <th> </th>
                           </tr>
                        </thead>
                        <?php $serial = 1; ?>								
                        @foreach ($views as $view)	
                        <tbody>
                           <tr>
                              <th scope="row">{{$serial}}</th>
                                 @foreach ($view->infos as $info)
                                    @if(isset($info->avatar))
                                    <td><img src="{{ url($info->avatar) }}" alt="{{ $view->name }}" class="img-circle" width="50px" height="50px"></td>
                                    @else
                                    <td><img src="{{asset('/extras/dummy.png')}}" alt="{{ $view->name }}" class="img-circle" width="50px" height="50px"></td>
                                    @endif
                                 @endforeach
                                 <td>{{$view->name}}</td>
                                    @foreach ($view->infos as $info)
                                       <td>{{$info->last_name}}</td>
                                       <td>{{$info->address}}</td>
                                       <td>{{$info->contact}}</td>
                                    @endforeach
                                 <td>{{$view->email}}</td>
                              <td>
                                 <div class="dropdown">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{ route('addPrefixByAdmin', ['id'=>$view->id]) }}"><i class="la la-edit"></i> Prefix</a>
                                       @can('update admin')
                                          <a class="dropdown-item" href="{{ route('editUserByAdmin', ['id'=>$view->id]) }}"><i class="la la-edit"></i> Edit</a>
                                       @endcan
                                       @can('delete admin')
                                          <a class="dropdown-item" href="#" data-dell_id="{{$view->id}}" data-toggle="modal" data-target="#deleteUserByAdmin"><i class="la la-trash-o"></i> Delete</a>
                                       @endcan
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        </tbody>
                  <?php $serial++ ?>
                  @endforeach
                  </table>
               </div>
            </div>
            <!--end::Section-->
         </div>
      </div>
      <!--end::Portlet-->
   </div>
</div>
</div>
<!--End::Section-->
@include('modals.user_by_admin')
@endsection