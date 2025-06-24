<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" />
  <style>
    .pink-btn {
      font-weight: bold;
      background: #e74e84;
      color: #fff;
      align-items: center;
      padding: 12px 25px;
      font-size: 15px;
      border-radius: 4px;
      border: 0px
    }

    .pink-btn a {
      color: #fff;
      text-decoration: none
    }

    .pink-btn:hover {
      background: #3f4079;
    }

    .blue-btn {
      font-weight: bold;
      background: #3f4079;
      color: #fff;
      align-items: center;
      padding: 12px 25px;
      font-size: 15px;
      border-radius: 4px;
      border: 0px
    }

    .blue-btn a {
      color: #fff;
      text-decoration: none
    }

    .blue-btn:hover {
      background: #e74e84;
    }
  </style>
</head>

<body
  style="width:100%;height:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:poppins, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
  <table border="0" cellpadding="0" cellspacing="0"
    style="width:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:poppins, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
    <tr>
      <td valign="top" style="display:block;clear:both;margin:0 auto;max-width:580px;">
        <table border="0" cellpadding="0" cellspacing="0" style="width:100%;border-collapse:collapse;">
          <tr>
            <td valign="top" align="center" class="masthead"
              style="padding:20px 0px 5px 0px;background:#3f4079;color:white;">
              <h1 style="font-size:32px;margin:0 auto;max-width:90%;line-height:1.25;">
                <a href="{{ url('/') }}" target="_blank"
                  style="text-decoration:none;color:#ffffff;">{{ config('app.name') }}</a>
                <p style="margin-bottom:0;line-height:12px;font-weight:normal;margin-top:15px;font-size:18px;"></p>
              </h1>
            </td>
          </tr>
          <tr>
            <td valign="top" class="content" style="background:white;padding:25px;">
              <p style="text-align: justify">
                <b>Dear {{ $name }}</b>, <br> <br>

                Thank you for participating in the Online Scholarship Exam for the MBBS Scholarship 2025, organized by
                Gyandeep Welfare & Rehabilitation Society in collaboration with the <b>Embassy of Kyrgyzstan in
                  India</b> and
                Eurasian International University (EIU), Kyrgyzstan. <br> <br>

                We’re pleased to share your exam results below: <br> <br>

              <table border="1" style="width: 100%; border-spacing: 0px; margin: 10px 0px;">
                <thead style="background-color: #3f4079;color: #fff;font-size: 14px;">
                  <tr>
                    <th style="text-align: center; padding:6px; ">Subject</th>
                    <th style="text-align: center; padding:6px; ">Correct</th>
                    <th style="text-align: center; padding:6px; ">Attempted</th>
                    <th style="text-align: center; padding:6px; ">Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($scores as $score)
                    <tr>
                      <td style="text-align: center; padding:6px; text-transform: capitalize; ">{{ $score['subject'] }}
                      </td>
                      <td style="text-align: center; padding:6px; text-transform: capitalize; ">{{ $score['correct'] }}
                      </td>
                      <td style="text-align: center; padding:6px; text-transform: capitalize; ">
                        {{ $score['attempted'] }}</td>
                      <td style="text-align: center; padding:6px; text-transform: capitalize; ">{{ $score['total'] }}
                      </td>
                    </tr>
                  @endforeach
                  <tr>
                    <th
                      style="text-align: center; padding:6px;font-size: 14px; text-transform: capitalize; background-color: #3f4079; color: #fff; ">
                      Total</th>
                    <th
                      style="text-align: center; padding:6px;font-size: 14px; text-transform: capitalize; background-color: #3f4079; color: #fff; ">
                      {{ $grandCorrect }}</th>
                    <th
                      style="text-align: center; padding:6px;font-size: 14px; text-transform: capitalize; background-color: #3f4079; color: #fff; ">
                      {{ count($scores) ? array_sum(array_column($scores, 'attempted')) : 0 }}</th>
                    <th
                      style="text-align: center; padding:6px;font-size: 14px; text-transform: capitalize; background-color: #3f4079; color: #fff; ">
                      {{ $grandTotal }}</th>
                  </tr>
                </tbody>
              </table>
              <br> <br>
              🟢 <b>Result: Shortlisted for Interview</b> <br><br>

              Based on your total score, you have been <b>shortlisted for the next stage</b> of the process — <b>an
                official
                interview</b> coordinated by the <b>Embassy of Kyrgyzstan in India</b>. <br> <br>

              <b>Your scholarship letter is attached to this email</b>. Please read it carefully. <br> <br>

              We will contact you shortly with interview details and document submission guidelines. Please keep your
              documents ready. <br><br>

              If you have any queries, feel free to reach out: <br>
              📧 Email : info@gyandeep.ngo <br>
              📞 Phone : <b>+91-92893-33536</b> <br><br>

              <b>Warm Regards,</b> <br>
              Admissions Team <br>
              <b>Gyandeep Welfare & Rehabilitation Society</b> <br>
              🌐 <a href="https://www.gyandeep.ngo">www.gyandeep.ngo</a>
              </p>
            </td>
          </tr>
          <tr>
            <td valign="top" align="center" class="masthead" style="padding:20px 0;background:#3f4079;color:white;">
              <h1 style="font-size:32px;margin:0 auto;max-width:90%;line-height:1.25;">
              </h1>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
