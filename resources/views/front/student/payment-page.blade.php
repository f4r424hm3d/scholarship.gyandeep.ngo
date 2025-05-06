@php
  $c_url = request()->path();
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Payment Details - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div id="breadcrumb">
      <div class="container">
        <ul>
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Payment Details</li>
        </ul>
      </div>
    </div>
    <!-- /breadcrumb -->

    <div class="container margin_60">
      <div class="row">
        <div class="col-xl-8 col-lg-8">
          <div class="box_general_3 cart">
            <div class="form_title">
              <h3>Payment Information</h3>
            </div>
            <form action="{{ url('student/scholarship/exam/payment') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="scholarship_token" value="{{ $_GET['token'] }}">
              <input type="hidden" name="back_url" value="{{ $_GET['url'] }}">
              <input type="hidden" name="application_id" value="{{ $_GET['id'] }}">
              <div class="step">
                <div class="form-group">
                  <label>Name of Account holder <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="from" name="from" placeholder="Jhon Doe"
                    value="{{ old('from') }}">
                  <span class="text-danger">
                    @error('from')
                      {{ $message }}
                    @enderror
                  </span>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Amount <span class="text-danger">*</span></label>
                      <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter Amount"
                        value="{{ old('amount') }}">
                      <span class="text-danger">
                        @error('amount')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Transaction Id <span class="text-danger">*</span></label>
                      <input type="text" id="transaction_id" name="transaction_id" class="form-control"
                        placeholder="Enter Transaction Id" value="{{ old('transaction_id') }}">
                      <span class="text-danger">
                        @error('transaction_id')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Payment Date <span class="text-danger">*</span></label>
                      <input type="date" id="payment_date" name="payment_date" class="form-control"
                        placeholder="Enter Payment Date" value="{{ old('payment_date') }}">
                      <span class="text-danger">
                        @error('payment_date')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Payment Through <span class="text-danger">*</span></label>
                      <input type="text" id="payment_through" name="payment_through" class="form-control"
                        placeholder="Eg: UPI , Bank Transafer" value="{{ old('payment_through') }}">
                      <span class="text-danger">
                        @error('payment_through')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Upload Payment Receipt <span class="text-danger">*</span></label>
                      <input type="file" id="payment_receipt" name="payment_receipt" class="form-control"
                        placeholder="Enter Payment Date" value="{{ old('payment_receipt') }}">
                      <span class="text-danger">
                        @error('payment_receipt')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="">
                    <button class="btn btn-primary" type="submit">Save</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </main>
@endsection
