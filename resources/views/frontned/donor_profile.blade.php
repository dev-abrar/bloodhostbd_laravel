@extends('frontned.master')

@section('content')
     <!-- ===========================================
                  banner Part Start 
  ================================================-->
  <section id="about_banner" style="background: linear-gradient(to bottom, rgba(23, 23, 59, 0.9), rgba(23, 23, 59, 0.7)), url('{{asset('frontend/images/counter.jpg')}}') no-repeat center/cover ;">
    <!-- single banner -->
      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto">
            <div class="about_banner_content text-center">     
              <h4>Profile</h4>
              <ul class="page-breadcrumb d-flex justify-content-center align-items-center mt-4">
                  <li><i class="fa fa-house "></i><a href="{{route('index')}}">Home</a></li>
                  <li>donor-profile</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</section>




  <!-- ===================================
                Donor Profile Info
  =========================================-->
<section id="donor-profile">
    <div class="container">
        <div class="row">
           <div class="col-lg-4 col-md-6" >
                <div class="user_info">
                  <div class="card">
                    <div class="card-header">
                      <h3>Profile</h3>
                    </div>
                    <div class="card-body">
                      <div class="user_img">
                        @if (Auth::guard('donorlogin')->user()->donor_img == null)
                        <img src="{{asset('frontend/images/donor-img-null .jpg')}}" width="100" class="d-block img-fluid" alt="">
                        @else
                        <img src="{{asset('upload/donor')}}/{{Auth::guard('donorlogin')->user()->donor_img}}" width="100" class="d-block img-fluid" alt="">
                        @endif
                          
                      </div>
                      <div class="user_content">
                        <h5>{{Auth::guard('donorlogin')->user()->name}}</h5>
                      </div>
                        <div class="user_details">
                          @if (Auth::guard('donorlogin')->user()->address)
                          <p><i class="fa-solid fa-location-dot"></i><span>{{Auth::guard('donorlogin')->user()->address}}</span></p>
                          @endif
                          <p><i class="fa-solid fa-envelope"></i><span>{{Auth::guard('donorlogin')->user()->email}}</span></p>
                          <p><i class="fa-solid fa-phone"></i></i><span>{{Auth::guard('donorlogin')->user()->phone}}</span></p>
                        </div>
                    </div>
                </div>
                </div>
           </div>
           <div class="col-lg-8 col-md-6">
              <div class="user_edit_form">
                  <div class="card">
                    <div class="card-header">
                        <h3>Update Profile </h3>
                    </div>
                    @if (session('succ'))
                        <div class="alert alert-success">{{session('succ')}}</div>
                    @endif
                    @if (session('login_first'))
                        <div class="alert alert-danger">{{session('login_first')}}</div>
                    @endif
                    <div class="card-body">
                      <form action="{{route('donor.profile.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="row">
                              <div class="col-lg-6 mb-3">
                                  <label class="form-label">Name</label>
                                  <input type="text" name="name" class="form-control" value="{{Auth::guard('donorlogin')->user()->name}}">
                              </div>
                              <div class="col-lg-6 mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="text" name="email" class="form-control" value="{{Auth::guard('donorlogin')->user()->email}}">
                            </div>
                              <div class="col-lg-6 mb-3">
                                <label class="form-label">Old Password</label>
                                <input type="password" name="old_password" class="form-control">
                                @if (session('wrong'))
                                    <strong class="text-danger">{{session('wrong')}}</strong>
                                @endif
                            </div>
                              <div class="col-lg-6 mb-3">
                                <label class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                              <div class="col-lg-12 mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" value="{{Auth::guard('donorlogin')->user()->address}}">
                              </div>
                              <div class="col-lg-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="number" name="phone" class="form-control" value="{{Auth::guard('donorlogin')->user()->phone}}">
                            </div>
                              <div class="col-lg-6 mb-3">
                                  <label class="form-label">District</label>
                                  <select class="custom-select city_id form-control" name="city_id" style="height: 40px" id="city_id">
                                    <option value="">--select district--</option>

                                    @foreach ($cites  as $city )
                                      <option value="{{$city->id}}" {{Auth::guard('donorlogin')->user()->city_id == $city->id?'selected':''}}>{{$city->city_name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-6 mb-3">
                                  <label class="form-label">Upazila</label>
                                  <select class="custom-select subcity_id form-control" name="subcity_id" id="subcity_id" style="height: 40px">
                                    <option value="">--select upazila--</option>
                                    @foreach ($subcites  as $subcity )
                                      <option value="{{$subcity->id}}" {{Auth::guard('donorlogin')->user()->subcity_id == $subcity->id?'selected':''}}>{{$subcity->name}}</option>
                                    @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-6 mb-3">
                                <label class="form-label">Blood Group</label>
                                <select name="blood" class="form-select">
                                    <option value="">select blood group</option>
                                    @foreach ($bloods as $blood)
                                    <option value="{{$blood->id}}" {{Auth::guard('donorlogin')->user()->blood_id == $blood->id?'selected':''}}>{{$blood->blood_group}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label class="form-label">Gender</label>
                              <select name="gender" id="" class="form-select">
                                  <option value="">select gender</option>
                                  <option value="1" {{Auth::guard('donorlogin')->user()->gender==1?'selected':''}}>Male</option>
                                  <option value="2">Female</option>
                              </select>
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label class="form-label">Religion</label>
                              <input type="text" name="religion" class="form-control" value="{{Auth::guard('donorlogin')->user()->religion}}">
                            </div>
                            <div class="col-lg-6 mb-3">
                              <label class="form-label">Date of Birth</label>
                              <input type="date" name="birth_date" class="form-control" value="{{Auth::guard('donorlogin')->user()->birth_date}}">
                            </div>
                              <div class="col-lg-6 mb-3">
                                <label class="form-label">Upload Image</label>
                                <input type="file" name="donor_img" class="form-control">
                                @error('donor_img')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                                @if (session('photo_error'))
                                  <strong class="text-danger">{{session('photo_error')}}</strong>
                              @endif
                              </div>
                              <div class="col-lg-12 mb-3">
                                  <button type="submit" class="btn btn-dark">Update Profile</button>
                              </div>
                          </div>
                      </form>
                    </div>
                  </div>
              </div>
           </div>
        </div>
    </div>
</section>




@endsection

@section('footer_script')
    <script>
      // Select 2
  $(document).ready(function() {
      $('.city_id').select2();
      $('.subcity_id').select2();
  });
  </script>

@endsection