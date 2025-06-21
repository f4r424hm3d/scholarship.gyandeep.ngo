<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>{{ $letter->student->name }} - Letter Head - {{ date('YmdHis') }}</title>
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
      width: 220px;
    }

    header .right-links {
      width: 300;
      float: right
    }

    header .right-links .mobile {
      font-size: 17px;
      font-weight: 600;
      display: flex;
      align-items: center;
      margin-bottom: 7px
    }

    header .right-links .mobile img {
      width: 17px;
      margin-right: 16px
    }

    header .right-links .email {
      font-size: 17px;
      display: flex;
      align-items: center;
      margin-bottom: 7px
    }

    header .right-links .email img {
      width: 25px;
      margin-right: 8px
    }

    header .right-links .website {
      font-size: 17px;
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
      padding: 15px 50px;
      text-align: justify;
    }

    .content-area .sign-stamp {
      width: auto;
      margin-top: -10px
    }

    .content-area .sign-stamp .sign img {
      width: 130px;
      float: left;
      margin-left: 80px
    }

    .content-area .sign-stamp .stamp img {
      width: 230px;
      float: right
    }

    footer {
      width: 92%;
      font-family: Arial;
      bottom: 0px;
      position: fixed;
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
      width: 20px;
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

<body>
  <table class="report-container">
    <thead class="report-header">
      <tr>
        <th class="report-header-cell">
          <div class="header-info">
            <header class="divHeader">
              <div class="logo"><img src="{{ asset($letter->company->logo_path) }}" /></div>
              <div class="right-links">
                <div class="mobile"><img
                    src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/mobile.jpg" />
                  {{ $letter->company->mobile }}</div>
                <div class="email"><img
                    src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/email.jpg" />
                  {{ $letter->company->email }}</div>
                <div class="website"><img
                    src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/website.jpg" />
                  {{ $letter->company->website_address }}
                </div>
              </div>
            </header>
            <div class="header-line">
              <!-- <span></span> -->
            </div>
            <br>
          </div>
        </th>
      </tr>
    </thead>
    <tbody class="report-content">
      <tr>
        <td class="report-content-cell">
          <div class="main">
            <div class="content-area">
              <br>
              {!! $letter->letter_description !!}
              <br><br>
              @if ($letter->signature == 1 || $letter->stamp == 1)
                <div class="sign-stamp">
                  @if ($letter->signature == 1 && $letter->company->signature_path != null)
                    <div class="sign"><img src="{{ asset($letter->company->signature_path) }}" /></div>
                  @endif
                  @if ($letter->stamp == 1 && $letter->company->stamp_path != null)
                    <div class="stamp"><img src="{{ asset($letter->company->stamp_path) }}" /></div>
                  @endif
                </div>
                <br><br>
              @endif
            </div>
          </div>
        </td>
      </tr>
    </tbody>
    <tfoot class="report-footer">
      <tr>
        <td class="report-footer-cell">
          <div class="footer-info">
            <div class="divFooter">
              <footer>
                <div class="footer-line">
                  <!-- <span></span> -->
                </div>
                <div class="footer-links">
                  <img src="https://www.crm.britannicaoverseas.com/uploads/letterhead/images/marker.jpg" />
                  {{ $letter->company->address }}
                </div>
              </footer>
              <br><br>
              <br><br>
              <br><br>
              <br><br>
            </div>
          </div>
        </td>
      </tr>
    </tfoot>
  </table>
  <script>
    window.print();
    //window.onafterprint = window.close;
  </script>
</body>

</html>
