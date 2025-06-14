<div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-4">
  <div class="pb-2">
    <div class="strip_list">
      <div class="text-center fixedss">
        <div class="profile-imges">
          <img src="{{ avatar($student->photo_path, $student->gender) }}" class="w-100 rounded-3">
        </div>
        <h5 class="mt-2 text-center">{{ $student->name }}</h5>
      </div>

      <div role="tablist" class="accordion main-acco mt-4" id="payment">
        <div class="row">
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-sm-2 mb-md-3 ">
            <div class="card mainpars ">
              <a href="{{ url('profile') }}">
                <i class="fa fa-user me-2" aria-hidden="true"></i> <span class="profiles">
                  Profile
                </span>
              </a>
            </div>
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-sm-2 mb-md-3 ">
            <div class="card mainpars ">
              <a href="{{ url('profile/change-password') }}">
                <i class="fa fa-lock me-2" aria-hidden="true"></i> 
                 <span class="profiles">Change Password</span>
                
                
              </a>
            </div>
          </div>
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-sm-2 mb-md-3 ">
            <div class="card mainpars ">
              <a href="{{ url('profile/applied-scholarship') }}">
                <i class="fa fa-graduation-cap me-2" aria-hidden="true"></i>
                
                <span class="profiles">  Start Exam</span>
               
              </a>
            </div>
          </div>
          {{-- <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-sm-2 mb-md-3 ">
              <div class="card mainpars ">
          <a href="{{ url('student/tests') }}">
            <i class="fa fa-list-alt me-2" aria-hidden="true"></i> Applied Tests
          </a>
        </div>
          </div> --}}
          <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-sm-2 mb-md-3 ">
            <div class="card mainpars ">
              <a href="{{ url('student/attended-tests') }}">
                <i class="fa fa-users me-2" aria-hidden="true"></i>
                 <span class="profiles"> Attended Tests</span>
               
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
