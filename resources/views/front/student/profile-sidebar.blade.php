<div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 mb-4">
  <div class="pb-2">
    <div class="strip_list">
      <div class="text-center">
        <div class="profile-imges">
          <img src="{{ avatar($student->photo_path, $student->gender) }}" class="w-100 rounded-3">
        </div>
        <h5 class="mt-2 text-center">{{ $student->name }}</h5>
      </div>

      <div role="tablist" class="accordion main-acco mt-4" id="payment">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-3">
            <div class="card">
              <a href="{{ url('profile') }}">
                <i class="fa fa-user me-2" aria-hidden="true"></i> Profile
              </a>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-3">
            <div class="card">
              <a href="{{ url('profile/change-password') }}">
                <i class="fa fa-lock me-2" aria-hidden="true"></i> Change Password
              </a>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-3">
            <div class="card">
              <a href="{{ url('profile/applied-scholarship') }}">
                <i class="fa fa-graduation-cap me-2" aria-hidden="true"></i> Start Exam
              </a>
            </div>
          </div>
          {{-- <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-3">
              <div class="card">
          <a href="{{ url('student/tests') }}">
            <i class="fa fa-list-alt me-2" aria-hidden="true"></i> Applied Tests
          </a>
        </div>
          </div> --}}
          <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-12 mb-3">
            <div class="card">
              <a href="{{ url('student/attended-tests') }}">
                <i class="fa fa-users me-2" aria-hidden="true"></i> Attended Tests
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
