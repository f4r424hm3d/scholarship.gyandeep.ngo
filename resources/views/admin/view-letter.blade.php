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
      <table align="center" width="700" cellpadding="0" cellspacing="0" border="0"
        style="border-collapse: collapse; font-family: Arial, sans-serif; border:1px solid #0000002e; padding:5px; background-color: #fff;">
        <tr>
          <td style="text-align:left; padding:10px; padding-bottom: 0px;">
            <span style="font-size:12px; font-weight:bold; ">Reg. No. 92/2014 - 15</span>
          </td>
          <td style="text-align:right; padding:10px; padding-bottom: 0px;">
            &nbsp;
          </td>
        </tr>
        <tr>
          <td style="text-align:left; padding:10px; width: 10%;">
            <img src="{{ asset($letter->company->logo_path) }}" alt="GYANDEEP WELFARE & REHABILITATION SOCIETY"
              style="display:block;width: 232px;" />
          </td>

          <td style="width: 80%; padding: 10px;">
            <p
              style="text-align:center;font-size: 36px;font-weight:bold;margin: 0px;color: #dd3333;font-family: 'OnStage Regular', Arial, sans-serif;">
              GYANDEEP WELFARE & REHABILITATION SOCIETY</p>
            <p style="text-align:center;font-size:14px;font-weight:normal;margin: 2px;">
              RUNNING : DEEP SPECIAL SCHOOL
            </p>
          </td>
        </tr>

        <tr>
          <td colspan="2"
            style="background-color:#3d2a8c !important; color:#fff !important; text-align:center; padding:8px; font-size:16px; -webkit-print-color-adjust: exact; print-color-adjust: exact;">
            Dasuya District Hoshiarpur Punjab - 144205
          </td>
        </tr>
        <tr>
          <td style="font-size:14px; padding:15px;" align="left">
            Ref. No. .................
          </td>
          <td style="font-size:14px; padding:15px;" align="right">
            Date: ....................
          </td>
        </tr>
        <tr>
          <td colspan="2" style="border-bottom:1px solid #000;"></td>
        </tr>
        <tr>
          <td colspan="2" style="font-size:14px; padding:20px;" align="left">
            <p style="margin:0 0 15px 0; font-size:14px; color:#333;">
              {!! $letter->letter_description !!}
            </p>
          </td>
        </tr>

        <tr>
          <td colspan="2" style="border-bottom:1px solid #000;"></td>
        </tr>
        <tr>
          <td colspan="2" style="font-size:12px; padding:10px;" align="center">
            📱 +91711908590 | +918882662310 | +919870406867<br />
            📧 info@gyandeep.ngo
            &nbsp; 🌐 www.gyandeep.ngo
          </td>
        </tr>
      </table>
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
