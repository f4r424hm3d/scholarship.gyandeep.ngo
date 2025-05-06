@php
  $n1 = rand(0, 20);
  $n2 = rand(0, 9);
  $key = $n1 + $n2;
@endphp
@extends('front.layouts.main')
@push('title')
  <title>{{ ucwords($row->service_name) }} - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main class="theia-exception">
    <div id="breadcrumb">
      <div class="container-fluid">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a target="_top" href="{{ url('/services') }}">Services</a></li>
          <li>{{ ucwords($row->service_name) }}</li>
        </ul>
      </div>
    </div>

    <div class="container margin_60_35">
      <div class="main_title text-start mb-4">
        <h2 class="text-start">{{ $row->service_name }}</h2>
      </div>

      <div class="row justify-content-between">
        <div class="col-lg-8">

          <div class="bloglist singlepost">
            <p><img alt="{{ $row->service_name }}" class="img-fluid" src="{{ asset($row->image_path) }}"></p>
            <div class="post-content">
              {!! $row->description !!}
            </div>
          </div>

        </div>

        <aside class="col-lg-4">
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
          <div class="box_general_3 booking">
            <div class="title">
              <h3>Get a Free Quote</h3>
              <!--small>Monday to Friday 09.00am-06.00pm</small-->
            </div>
            <form method="post" action="{{ url('get-quote') }}" id="booking">
              @csrf
              <input type="hidden" name="key1" value="{{ $key }}">
              <input type="hidden" name="back_url" value="{{ request()->path() }}">
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
                <div class="col-md-12 col-sm-12">
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
                <div class="col-md-12 col-sm-12">
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
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <textarea rows="5" id="message" name="message" class="form-control" style="height:80px;"
                      placeholder="Hello world!">{{ old('message') }}</textarea>
                  </div>
                </div>
                <div class="col-md-12 col-sm-12">
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
              <div style="position:relative;">
                <input type="submit" class="btn_1 full-width" value="Get Free Quotation">
              </div>
            </form>
          </div>

        </aside>
      </div>
    </div>

  </main>
@endsection
