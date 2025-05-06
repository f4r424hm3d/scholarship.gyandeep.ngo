@extends('front.layouts.main')
@push('title')
  <title>Edit Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.provider.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
          <div style="clear:both"></div>
          <div class="pb-2">
            <div id="detail-title" style="padding-left:15px"><i class="icon-info-circled"></i> Account Holder Information
            </div>
            <div class="box_general_3">
              <form action="{{ url('provider/profile/update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $provider->id }}">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Name</label>
                      <input name="name" type="text" class="form-control" placeholder="Your name"
                        value="{{ $provider->name }}" required>
                      <span class="text-danger">
                        @error('name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Gender</label>
                      <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ $provider->gender == 'Male' ? 'Selected' : '' }}>Male</option>
                        <option value="Female" {{ $provider->gender == 'Female' ? 'Selected' : '' }}>Female</option>
                        <option value="Other" {{ $provider->gender == 'Other' ? 'Selected' : '' }}>Other</option>
                      </select>
                      <span class="text-danger">
                        @error('gender')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Date of Birth</label>
                      <input name="dob" type="date" class="form-control" placeholder="Date of Birth"
                        value="{{ $provider->dob }}" required>
                      <span class="text-danger">
                        @error('dob')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Nationality</label>
                      <select name="nationality" class="form-control" placeholder="Country" required>
                        <option value="">Country</option>
                        @foreach ($country as $n)
                          <option value="{{ $n->name }}"
                            {{ (old('nationality') && old('nationality') == $n->name) || $n->name == $provider->nationality ? 'Selected' : '' }}>
                            {{ $n->name }}
                          </option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('nationality')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <div class="form-group">
                      <label>Country Code</label>
                      <select name="c_code" class="form-control" placeholder="Country" required>
                        <option value="">Country</option>
                        @foreach ($cc as $c)
                          <option value="{{ $c->phonecode }}"
                            {{ (old('c_code') && old('c_code') == $c->phonecode) || $c->phonecode == '91' || $c->phonecode == $provider->c_code ? 'Selected' : '' }}>
                            {{ $c->name }}
                            (+{{ $c->phonecode }})
                          </option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('c_code')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label>Mobile</label>
                      <input name="mobile" type="number" class="form-control" placeholder="Phone No."
                        value="{{ $provider->mobile }}" required>
                      <span class="text-danger">
                        @error('mobile')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Provider Type</label>
                      <select name="provider_type_id" type="text" class="form-control select2" required>
                        <option value="">Select</option>
                        @foreach ($pt as $pt)
                          <option value="{{ $pt->id }}"
                            {{ $provider->provider_type_id == $pt->id ? 'Selected' : '' }}>
                            {{ $pt->provider_type }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('provider_type_id')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Enter Provider Name</label>
                      <input name="provider_name" type="text" class="form-control" placeholder="provider Name"
                        value="{{ old('provider_name') ?? $provider->provider_name }}" required>
                      <span class="text-danger">
                        @error('provider_name')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Global Rank</label>
                      <input name="global_rank" type="number" class="form-control" placeholder="Enter global_rank"
                        value="{{ old('global_rank') ?? $provider->global_rank }}">
                      <span class="text-danger">
                        @error('global_rank')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>acceptance Rate</label>
                      <input name="acceptance_rate" type="text" class="form-control"
                        placeholder="Enter acceptance Rate"
                        value="{{ old('acceptance_rate') ?? $provider->acceptance_rate }}">
                      <span class="text-danger">
                        @error('acceptance_rate')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Established Year</label>
                      <input name="established" type="text" class="form-control"
                        placeholder="Enter Established Year"
                        value="{{ old('established') ?? $provider->established }}">
                      <span class="text-danger">
                        @error('established')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Address</label>
                      <input name="address" type="text" class="form-control" placeholder="Enter address"
                        value="{{ old('address') ?? $provider->address }}">
                      <span class="text-danger">
                        @error('address')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>city</label>
                      <input name="city" type="text" class="form-control" placeholder="Enter city"
                        value="{{ old('city') ?? $provider->city }}">
                      <span class="text-danger">
                        @error('city')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>state</label>
                      <input list="statesl" name="state" type="text" class="form-control"
                        placeholder="Enter state" value="{{ old('state') ?? $provider->state }}">
                      <datalist id="statesl">
                        @foreach ($state as $s)
                          <option value="{{ $s->statename }}">
                        @endforeach
                      </datalist>
                      <span class="text-danger">
                        @error('state')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Country</label>
                      <select name="country" id="country" type="text" class="form-control select2"
                        data-placeholder="Select Country" required>
                        <option value="">Select</option>
                        @foreach ($country as $cn)
                          <option value="{{ $cn->name }}" {{ $provider->country == $cn->name ? 'Selected' : '' }}>
                            {{ $cn->name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger">
                        @error('country')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>

                <input type="submit" class="btn_1 medium" value="Save">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
@endsection
