@extends('admin.layouts.main')
@push('title')
  <title>{{ $page_title }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('main-section')
  <style>
    body {
      background: white;
    }

    page {
      background: white;
      position: relative;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.3cm rgba(0, 0, 0, 0.2);
    }

    page[size="A4"] {
      width: 21cm;
      height: 100%;
    }

    header {
      padding: 30px 30px 15px 30px;
      display: flow-root;
      font-family: Arial
    }

    header .logo {
      width: 250px;
      float: left
    }

    header .logo img {
      width: 250px;
    }

    header .right-links {
      width: 206px;
      float: right
    }

    header .right-links .mobile {
      font-size: 23px;
      font-weight: 600;
      display: flex;
      align-items: center;
      margin-bottom: 7px
    }

    header .right-links .mobile img {
      width: 22px;
      margin-right: 10px
    }

    header .right-links .email {
      font-size: 13px;
      display: flex;
      align-items: center;
      margin-bottom: 7px
    }

    header .right-links .email img {
      width: 25px;
      margin-right: 8px
    }

    header .right-links .website {
      font-size: 13px;
      display: flex;
      align-items: center;
    }

    header .right-links .website img {
      width: 25px;
      margin-right: 8px
    }

    .header-line {
      width: auto;
      background: #eee;
      height: 5px;
      margin: 0px 30px
    }

    .header-line span {
      width: 80px;
      background: #e7087f;
      height: 5px;
      z-index: 9;
      position: absolute
    }

    .content-area {
      font-family: "Times New Roman", Times, serif;
      font-size: 16px;
      padding: 30px 50px;
      text-align: justify
    }

    .content-area .sign-stamp {
      width: auto;
      margin-top: -10px
    }

    .content-area .sign-stamp .sign img {
      width: 150px;
      float: left;
      margin-left: 100px
    }

    .content-area .sign-stamp .stamp img {
      width: 300px;
      float: right
    }

    footer {
      width: 92%;
      font-family: Arial;
      bottom: 0px;
      position: absolute;
      padding: 30px 30px 35px 30px
    }

    .footer-line {
      width: auto;
      background: #eee;
      height: 5px;
      margin-bottom: 20px
    }

    .footer-line span {
      width: 80px;
      background: #e7087f;
      height: 5px;
      z-index: 9;
      position: absolute
    }

    footer .footer-links {
      font-size: 13px;
      font-weight: 600;
      display: flex;
      align-items: center;
    }

    footer .footer-links img {
      width: 30px;
      margin-right: 10px
    }

    .footer-stripe {
      width: 100%;
      height: 15px;
      background: #800245;
      bottom: 0px;
      position: absolute;
    }

    @media print {

      body,
      page {
        margin: 0;
        box-shadow: 0;
      }
    }
  </style>
  <main class="content">
    <div class="container-fluid p-0">
      <div class="letter">
        <div class="col-12">
          <a style="float:right;" target="_blank" href="{{ url('admin/print-scholarship-letter/' . $id) }}"
            data-toggle="tooltip" class="btn btn-outline-faraz btn-sm" title="Go to Receipts">Print</a>
        </div>
      </div>
      <hr>
      <page size="A4">
        <header>
          <div class="logo"><img src="{{ asset($letter->company->logo_path) }}" /></div>
          <div class="right-links">
            <div class="mobile"><img src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/mobile.jpg" />
              {{ $letter->company->mobile }}</div>
            <div class="email"><img src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/email.jpg" />
              {{ $letter->company->email }}</div>
            <div class="website"><img
                src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/website.jpg" />
              {{ $letter->company->website_address }}
            </div>
          </div>
        </header>
        <div class="header-line"><span></span></div>
        <div class="content-area">
          {{ $letter->letter_description }}
          @if ($letter->signature == 1 || $letter->stamp == 1)
            <div class="sign-stamp">
              @if ($letter->signature == 1)
                <div class="sign"><img src="{{ asset($letter->company->signature_path) }}" /></div>
              @endif
              @if ($letter->stamp == 1)
                <div class="stamp"><img src="{{ asset($letter->company->stamp_path) }}" /></div>
              @endif
            </div>
            <br><br>
          @endif
        </div>
        <footer>
          <div class="footer-line"><span></span></div>
          <div class="footer-links">
            <img src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/marker.jpg" />
            {{ $letter->company->address }}
          </div>
        </footer>
        <br><br>
        <br><br>
        <br><br>
        <br><br>
        <div class="footer-stripe"></div>
      </page>
      <hr>
      <div class="letter">
        <div class="col-12">
          <a style="float:right;" target="_blank" href="{{ url('admin/print-scholarship-letter/' . $id) }}"
            data-toggle="tooltip" class="btn btn-outline-faraz btn-sm" title="Go to Receipts">Print</a>
        </div>
      </div>
    </div>
  </main>
@endsection
