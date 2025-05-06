@php
if ($student->gender == 'Male') {
    $avatar = 'avatars/male.png';
}
if ($student->gender == 'Female') {
    $avatar = 'avatars/female.png';
}
if ($student->gender == '') {
    $avatar = 'avatars/default.png';
}
@endphp
<div class="col-xl-2 col-lg-2">
  <div class="pb-2">
    <div class="strip_list">
      <div class="text-center">
        <img src="{{ url('front/') }}/{{ $avatar }}" class="w-100 rounded-3">
        <h5 class="mt-2 text-center">{{ $student->name }}</h5>
        {{-- <a href="#" class="btn_1 mt-2">Change Photo</a> --}}
      </div>

      <div role="tablist" class="accordion mt-4" id="payment">
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('profile') }}">
                Profile
              </a>
            </h5>
          </div>
        </div>
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('profile/change-password') }}">
                Change Password
              </a>
            </h5>
          </div>
        </div>
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('profile/applied-scholarship') }}">
                Applied Scholarship
              </a>
            </h5>
          </div>
        </div>
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('student/tests') }}">
                Applied Tests
              </a>
            </h5>
          </div>
        </div>
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('student/attended-tests') }}">
                Attended Tests
              </a>
            </h5>
          </div>
        </div>

        {{-- <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0"><a class="collapsed" data-bs-toggle="collapse" href="#collapseTwo_payment"
                aria-expanded="false"><i class="indicator icon_plus_alt2"></i>Dropdown</a></h5>
          </div>
          <div id="collapseTwo_payment" class="collapse" role="tabpanel" data-bs-parent="#payment">
            <div class="card-body">
              <p></p>
            </div>
          </div>
        </div> --}}

      </div>
    </div>

  </div>
</div>
