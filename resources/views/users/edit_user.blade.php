@extends('parent.admin')
@section('body')
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
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
   <!-- begin:: Content -->
   <div class="kt-content  kt-grid__item kt-grid__item--fluid">
      @if (count($errors)>0)
      <div class="alert" style="background-color:#c0302b;
      color:#fff;">
         <ul>
         @foreach ($errors->all() as $error)
            <li> {{$error}}</li>
         @endforeach
         </ul>
      </div>
      @endif
      <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
               <div class="kt-grid">
                  <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">
                     <!--begin: Form Wizard Form-->
                     <form method="POST" action="{{ route('updateUserByAdmin', ['id'=>$edits[0]['id']]) }}"  class="kt-form" id="kt_apps_user_add_user_form" enctype="multipart/form-data">
                        @csrf
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v4__content m-5" data-ktwizard-type="step-content" data-ktwizard-state="current">
                           <div class="kt-heading kt-heading--md">User's Profile Details:</div>
                           <div class="kt-section kt-section--first">
                              <div class="kt-wizard-v4__form">
                                 <div class="row">
                                    <div class="col-xl-12">
                                       @foreach ($edits as $edit)
                                       <div class="kt-section__body">
                                          <div class="form-group row">
                                             <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                             <div class="col-lg-9 col-xl-6">
                                                <div class="kt-avatar kt-avatar--outline kt-avatar--circle" id="kt_apps_user_add_avatar">
                                                   @foreach ($edit->infos as $info)
                                                      @if(isset($info->avatar))
                                                         <div class="kt-avatar__holder" style="background-image: url({{ url($info->avatar) }})">
                                                         </div>
                                                      @else
                                                         <div class="kt-avatar__holder" id="avatarPreviewDefault" style="background-image: url({{asset('/extras/dummy.png')}})">
                                                         </div>

                                                         <img src="" class="kt-avatar__holder" alt="" id="avatarPreviewNew" style="display:none;" width="100">
                                                      @endif
                                                   @endforeach
                                                      <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="" data-original-title="Change avatar">
                                                         <i class="fa fa-pen"></i>
                                                            <input type="file" name="avatar" id="avatar">
                                                            </label>
                                                            <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="" data-original-title="Cancel avatar">
                                                         <i class="fa fa-times"></i>
                                                      </span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                             <div class="col-lg-9 col-xl-9">
                                                <input class="form-control" name="first_name" value="{{$edit->name}}" type="text">
                                             </div>
                                          </div>
                                          @foreach ($edit->infos as $info)
                                             <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                <div class="col-lg-9 col-xl-9">
                                                   <input class="form-control" name="last_name" value="{{$info->last_name}}" type="text">
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Address</label>
                                                <div class="col-lg-9 col-xl-9">
                                                   <input class="form-control" name="address" value="{{$info->address}}" type="text" placeholder="14 street">
                                                </div>
                                             </div>
                                             <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                                <div class="col-lg-9 col-xl-9">
                                                   <div class="input-group">
                                                      <div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
                                                      <input type="text" class="form-control" name="contact" value="{{$info->contact}}" placeholder="Phone" aria-describedby="basic-addon1">
                                                   </div>
                                                   <span class="form-text text-muted">Add with Country Code</span>
                                                </div>
                                             </div>
                                          @endforeach
                                          <div class="form-group row">
                                             <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                             <div class="col-lg-9 col-xl-9">
                                                <div class="input-group">
                                                   <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                   <input type="text" class="form-control" name="email" value="{{$edit->email}}" placeholder="Email" aria-describedby="basic-addon1">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xl-3 col-lg-3 col-form-label">User Role</label>
                                             <div class="col-lg-9 col-xl-9">
                                                <select class="form-control" name="role">
                                                   @if($edit->role == '2')
                                                      <option data-offset="-39600" value="2" selected>Admin</option>
                                                      <option data-offset="-39600" value="3">Customer</option>
                                                   @elseif($edit->role == '3')
                                                      <option data-offset="-39600" value="3" selected>Customer</option>
                                                      <option data-offset="-39600" value="2">Admin</option>
                                                   @endif   
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       @endforeach
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end: Form Wizard Step 1-->
                        <!--begin: Form Actions -->
                        <div class="kt-form__actions m-5">
                           <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"> Update </button>
                        </div>
                        <!--end: Form Actions -->
                     </form>
                     <!--end: Form Wizard Form-->
                  </div>
               </div>
            </div>
         </div>
      
   </div>
   <!-- end:: Content -->
</div>
@endsection

@section("after-js")
<script>
   function readURL(input) {
      if (input.files && input.files[0]) {

         
         var reader = new FileReader();
         
         reader.onload = function(e) {
         console.log(e.target.result);
            $('#avatarPreviewDefault').hide();
            $('#avatarPreviewNew').attr('src', e.target.result);
            $('#avatarPreviewNew').show();
         }
         
         reader.readAsDataURL(input.files[0]); // convert to base64 string
   }
   }

   jQuery(document).ready(function(){
      $("#avatar").change(function() {
         readURL(this);
      });      
   });
   
</script>
@endsection