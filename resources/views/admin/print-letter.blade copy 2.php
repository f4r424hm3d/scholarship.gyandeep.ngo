<!DOCTYPE html>
<html>

<head>
  <style>
    @font-face {
      font-family: 'GyanDeepFont';
      src: url('https://yourwebsite.com/fonts/OnStage-Regular.woff2') format('woff2'),
        url('https://yourwebsite.com/fonts/OnStage-Regular.ttf') format('truetype');
    }

    @media print {
      table.report-container {
        page-break-after: always;
      }

      thead.report-header {
        display: table-header-group;
      }

      tfoot.report-footer {
        display: table-footer-group;
      }
    }
  </style>
</head>

<body style="margin:0;padding:0; background-color: #ffffff;">
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
  <script>
    window.print();
    //window.onafterprint = window.close;
  </script>
</body>

</html>