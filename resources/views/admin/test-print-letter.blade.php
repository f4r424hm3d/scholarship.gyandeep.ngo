<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Print Letter</title>
  <style>
    @font-face {
      font-family: 'GyanDeepFont';
      src: url("{{ asset('fonts/OnStage-Regular/OnStage-Regular.woff2') }}") format('woff2'),
        url("{{ asset('fonts/OnStage-Regular/OnStage-Regular.ttf') }}") format('truetype');
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #fff;
      font-size: 14px;
    }

    @page {
      margin: 130px 40px 100px 40px;
    }

    header {
      position: fixed;
      top: -110px;
      left: 0;
      right: 0;
      text-align: center;
    }

    footer {
      position: fixed;
      bottom: -80px;
      left: 0;
      right: 0;
      text-align: center;
      font-size: 12px;
      color: #000;
    }

    .letter-content {
      padding: 10px 0;
    }

    .logo {
      width: 220px;
    }

    .signature-area {
      text-align: right;
      margin-top: 50px;
    }

    .stamp {
      text-align: left;
      margin-top: 10px;
    }

    .title {
      font-size: 36px;
      font-weight: bold;
      color: #dd3333;
      font-family: 'GyanDeepFont', Arial, sans-serif;
      margin: 5px 0;
    }

    .sub-title {
      font-size: 14px;
      margin: 0;
    }

    .address-bar {
      background-color: #3d2a8c;
      color: #fff;
      padding: 6px;
      font-size: 15px;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }

    .meta-info {
      padding: 10px 0;
    }

    .divider {
      border-bottom: 1px solid #000;
      margin: 10px 0;
    }
  </style>
</head>

<body>

  {{-- Header --}}
  <header>
    <table width="100%">
      <tr>
        <td style="text-align: left; font-size: 12px; font-weight: bold;">Reg. No. 92/2014 - 15</td>
        <td style="text-align: right;"></td>
      </tr>
      <tr>
        <td style="width: 20%;">
          <img src="{{ public_path($letter->company->logo_path) }}" alt="Logo" class="logo">
        </td>
        <td style="width: 80%;">
          <div class="title">GYANDEEP WELFARE & REHABILITATION SOCIETY</div>
          <div class="sub-title">RUNNING : DEEP SPECIAL SCHOOL</div>
        </td>
      </tr>
      <tr>
        <td colspan="2" class="address-bar" align="center">
          Dasuya, District Hoshiarpur, Punjab - 144205
        </td>
      </tr>
      <tr class="meta-info">
        <td align="left">Ref. No. ....................</td>
        <td align="right">Date: ....................</td>
      </tr>
      <tr>
        <td colspan="2" class="divider"></td>
      </tr>
    </table>
  </header>

  {{-- Footer --}}
  <footer>
    📱 +91711908590 | +919870406867<br>
    📧 info@gyandeep.ngo &nbsp; 🌐 www.gyandeep.ngo
  </footer>

  {{-- Body --}}
  <main>
    <div class="letter-content">
      <p>Dear {{ $letter->student->name }},</p>

      <div>{!! $letter->letter_description !!}</div>

      {{-- Stamp and Signature --}}
      @if ($letter->company->signature_path || $letter->company->stamp_path)
        <table width="100%" style="margin-top: 50px;">
          <tr>
            <td style="width: 50%;">
              @if ($letter->company->stamp_path)
                <div class="stamp">
                  <img src="{{ public_path($letter->company->stamp_path) }}" height="100">
                </div>
              @endif
            </td>
            <td style="width: 50%;">
              @if ($letter->company->signature_path)
                <div class="signature-area">
                  <img src="{{ public_path($letter->company->signature_path) }}" height="80">
                </div>
              @endif
            </td>
          </tr>
        </table>
      @endif
    </div>
  </main>

</body>

</html>
