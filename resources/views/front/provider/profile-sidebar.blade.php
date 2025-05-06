@php
if ($provider->gender == 'Male') {
    $avatar = 'avatars/male.png';
}
if ($provider->gender == 'Female') {
    $avatar = 'avatars/female.png';
}
if ($provider->gender == '') {
    $avatar = 'avatars/default.png';
}
@endphp
<div class="col-xl-2 col-lg-2">
  <div class="pb-2">
    <div class="strip_list">
      <div class="text-center">
        <img src="{{ url('front/') }}/{{ $avatar }}" class="w-100 rounded-3">
        <h5 class="mt-2 text-center">{{ $provider->name }}</h5>
        {{-- <a href="#" class="btn_1 mt-2">Change Photo</a> --}}
        <a href="{{ url('provider/logout') }}" class="btn_1 mt-2">Logout</a>
      </div>

      <div role="tablist" class="accordion mt-4" id="payment">
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('provider/profile') }}">
                Profile
              </a>
            </h5>
          </div>
        </div>
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('provider/profile/change-password') }}">
                Change Password
              </a>
            </h5>
          </div>
        </div>
        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0">
              <a href="{{ url('provider/scholarship') }}">
                Scholarship
              </a>
            </h5>
          </div>
        </div>

        <div class="card">
          <div class="card-header p-2" role="tab">
            <h5 class="mb-0"><a class="collapsed" data-bs-toggle="collapse" href="#collapseTwo_payment"
                aria-expanded="false"><i class="indicator icon_plus_alt2"></i>Dropdown</a></h5>
          </div>
          <div id="collapseTwo_payment" class="collapse" role="tabpanel" data-bs-parent="#payment">
            <div class="card-body">
              <p></p>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>
