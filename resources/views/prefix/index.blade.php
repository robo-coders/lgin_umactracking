@extends('parent.admin')
@section('body')
   @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
         <div class="alert-text"> {{session()->get('success')}}</div>
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
                              <form action="{{ route('attachPrefix') }}" method="POST"  class="kt-form">
                              @csrf
                                 <td> 
                                    <div class="form-group row">
                                    <label class="col-xl-1 col-lg-1 col-form-label">Prefix: </label>
                                       <div class="col-lg-3 col-xl-3">
                                          <input class="form-control" name="prefix" type="text">
                                          <input name="user_id" hidden value="{{ $user->id }}" type="text">
                                       </div>
                                       <div class="col-lg-3 col-xl-3">
                                             <button class="btn btn-success btn-md mt-3 mt-md-0 btn-wide kt-font-bold kt-font-transform-u"> Attach </button>
                                       </div>
                                    </div>
                                 </td>
                              </form>
                            </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Portlet-->
            <div class="kt-portlet">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <h3 class="kt-portlet__head-title">
                        Prefix list
                     </h3>
                  </div>
               </div>
               <div class="kt-portlet__body">
                  <!--begin::Section-->
                  <div class="kt-section">
                     <div class="kt-section__content">
                        @if(count($user->prefix))
                           <table class="table">
                              <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Title </th>
                                    </tr>
                              </thead>
                              <tbody>
                                 @foreach ($user->prefix as $key => $prefix)
                                    <tr>
                                       <td>
                                          {{ $loop->iteration }}
                                       </td>
                                       <td>
                                          <form action="{{ route('updatePrefix',['prefix'=>$prefix]) }}" method="POST"  class="kt-form">
                                             @csrf
                                             <div class="row">
                                                <div class="col-lg-4 col-xl-4">
                                                   <input type=x"text" class="form-control" name="prefix" value="{{ $prefix->prefix }}">
                                                </div>
                                                <div class="col-lg-3 col-xl-3">
                                                   <button class="btn btn-success btn-md mt-3 mt-md-0 btn-wide kt-font-bold kt-font-transform-u"> Update </button>
                                                </div>
                                             </div>
                                          </form>
                                       </td>
                                    </tr>
                                    @endforeach
                              </tbody>
                           </table>
                        @else
                           <p class="font-weight-bold" align="center"> No prefix exists</p>   
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
</div>

@endsection