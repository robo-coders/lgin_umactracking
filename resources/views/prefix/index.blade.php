@extends('parent.admin')
@section('body')
   @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
         <div class="alert-text"> {{session()->get('success')}}</div>
      </div>
   @endif
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="row">
        <div class="col-xl-6">
            <!--begin::Portlet-->
            <div class="kt-portlet">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <h3 class="kt-portlet__head-title">
                        Prefix
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
                                  <th>Title </th>
                               </tr>
                           </thead>
                           <tbody>
                               <tr>
                                   <td> 1 </td>
                                   <td> 
                                    @if($user->prefix)
                                       {{ $user->prefix->prefix }}
                                    @else
                                       N/A
                                    @endif
                                 </td>
                               </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-xl-6">
            <!--begin::Portlet-->
            <div class="kt-portlet">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <h3 class="kt-portlet__head-title">
                        Attach Prefix
                     </h3>
                  </div>
               </div>
               <div class="kt-portlet__body">
                  <!--begin::Section-->
                  <div class="kt-section">
                     <div class="kt-section__content">
                        <table class="table">
                           <tbody>
                               <tr>
                                  @if($user->prefix)
                                    <form action="{{ route('updatePrefix',['id' => $user->id]) }}" method="POST"  class="kt-form">
                                    @csrf
                                       <td> 
                                          <div class="form-group row">
                                          <label class="col-xl-3 col-lg-3 col-form-label">Prefix: </label>
                                             <div class="col-lg-6 col-xl-6">
                                                <input class="form-control" name="prefix" value="{{ $user->prefix->prefix }}" type="text">
                                                <input hidden name="user_id" value="{{ $user->id }}" type="text">
                                             </div>
                                             <div class="col-lg-3 col-xl-3">
                                                   <button class="btn btn-success btn-md btn-wide kt-font-bold kt-font-transform-u"> Update </button>
                                             </div>
                                          </div>
                                       </td>
                                    </form>
                                  @else
                                    <form action="{{ route('attachPrefix') }}" method="POST"  class="kt-form">
                                    @csrf
                                       <td> 
                                          <div class="form-group row">
                                          <label class="col-xl-3 col-lg-3 col-form-label">Prefix: </label>
                                             <div class="col-lg-6 col-xl-6">
                                                <input class="form-control" name="prefix" type="text">
                                                <input hidden name="user_id" value="{{ $user->id }}" type="text">
                                             </div>
                                             <div class="col-lg-3 col-xl-3">
                                                   <button class="btn btn-success btn-md mt-3 mt-md-0 btn-wide kt-font-bold kt-font-transform-u"> Attach </button>
                                             </div>
                                          </div>
                                       </td>
                                    </form>
                                 @endif
                               </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
</div>

@endsection