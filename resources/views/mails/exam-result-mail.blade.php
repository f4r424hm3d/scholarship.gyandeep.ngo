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
  style="width:100%;height:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:Helvetica, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
  <table border="0" cellpadding="0" cellspacing="0"
    style="width:100%;background:#efefef;-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;color:#3E3E3E;font-family:Helvetica, Arial, sans-serif;line-height:1.65;margin:0;padding:0;">
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
                Dear {{ $name }}, <br>

                Thank you for participating in the Online Scholarship Exam for the MBBS Scholarship 2025, organized by
                Gyandeep Welfare & Rehabilitation Society in collaboration with the Embassy of Kyrgyzstan in India and
                Eurasian International University (EIU), Kyrgyzstan. <br>

                We’re pleased to share your exam results below: <br>

              <table border="1" cellpadding="10">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Correct</th>
                    <th>Attempted</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($scores as $score)
                    <tr>
                      <td>{{ $score['subject'] }}</td>
                      <td>{{ $score['correct'] }}</td>
                      <td>{{ $score['attempted'] }}</td>
                      <td>{{ $score['total'] }}</td>
                    </tr>
                  @endforeach
                  <tr>
                    <th>Total</th>
                    <th>{{ $grandCorrect }}</th>
                    <th>{{ count($scores) ? array_sum(array_column($scores, 'attempted')) : 0 }}</th>
                    <th>{{ $grandTotal }}</th>
                  </tr>
                </tbody>
              </table>

              🟢 Result: Shortlisted for Interview <br>
              Based on your total score, you have been shortlisted for the next stage of the process — an official
              interview coordinated by the Embassy of Kyrgyzstan in India. <br>

              We will contact you shortly with interview details and document submission guidelines. Please keep your
              documents ready. <br>

              If you have any queries, feel free to reach out: <br>
              📧 info@gyandeep.ngo <br>
              📞 +91 9711908590 <br>

              Warm regards, <br>
              Admissions Team <br>
              Gyandeep Welfare & Rehabilitation Society <br>
              www.gyandeep.ngo
              </p>
            </td>
          </tr>
          <tr>
            <td valign="top" align="center" class="masthead" style="padding:20px 0;background:#e74e84;color:white;">
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
