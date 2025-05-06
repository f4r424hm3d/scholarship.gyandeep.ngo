@php
  $n1 = rand(0, 20);
  $n2 = rand(0, 9);
  $key = $n1 + $n2;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Contact Us - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="#">Home</a></li>
          <li>Contact</li>
        </ul>
      </div>
    </div>

    <div class="bg_color_1">
      <div class="container margin_60_35">
        <div class="row">
          <aside class="col-lg-3 col-md-4">
            <div id="contact_info">
              <h3>Contacts info & Details</h3>
              <p class="text-justify">Do you want to advertise or list your scholarship on our site? We will be happy to
                assist you in this, please write us at <a
                  href="mailto:info@mudraeducation.org">info@mudraeducation.org</a>. Please use the official email of the
                university, organization, or funding agency. Any requests from non official emails will not be
                entertained.</p>
              <ul>
                <li><strong>Working hours:</strong>
                  10 am – 6 pm on weekdays</li>
                <li><strong>General questions:</strong>
                  <a href="+919818560331">(+91) 9818560331</a>, <a href="+919870406867">9870406867</a><br>
                  <a href="mailto:info@mudraeducation.org">info@mudraeducation.org</a>
                </li>
                <li><strong>Location:</strong>
                  <p>B-16 ground floor Gurugram, Mayfield Garden, Sector 50, Gurugram</p>
                </li>
              </ul>

              <h4>Get directions</h4>
              <a href="https://goo.gl/maps/jPTxAmwZGfdkRsAb8" target="_blank" class="btn_1 add_bottom_45">View in Google
                map</a>
            </div>
          </aside>

          <div class=" col-lg-8 col-md-8 ml-auto">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                {{ session()->get('emsg') }}
              </div>
            @endif
            <div class="box_general">
              <h3>Get In Touch</h3>
              <p>Fill In the Form for information or a meeting!</p>
              <div>
                <div id="message-contact"></div>
                <form method="post" action="{{ url('contact-us') }}" id="contactform">
                  @csrf
                  <input type="hidden" name="key1" value="{{ $key }}">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="form-group">
                        <input name="name" type="text" class="form-control" placeholder="Enter full name"
                          value="{{ old('name') }}" required>
                        <span class="text-danger">
                          @error('name')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <input name="email" type="email" class="form-control" placeholder="Enter Email Address"
                          value="{{ old('email') }}" required>
                        <span class="text-danger">
                          @error('email')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <div class="form-group">
                        <input name="mobile" type="number" class="form-control" placeholder="Phone No."
                          value="{{ old('mobile') }}" required>
                        <span class="text-danger">
                          @error('mobile')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea rows="5" id="message" name="message" class="form-control" style="height:80px;"
                          placeholder="Hello world!">{{ old('message') }}</textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="key" class=" form-control"
                          placeholder=" {{ $n1 }} + {{ $n2 }} =">
                        <span class="text-danger">
                          @error('key')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                  </div>
                  <input type="submit" value="Submit" class="btn_1 add_top_20" id="submit-contact">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
@endsection
