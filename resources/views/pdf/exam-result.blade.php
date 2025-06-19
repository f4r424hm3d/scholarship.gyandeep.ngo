<!DOCTYPE html>
<html>

<head>
  <title>Exam Result</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }
  </style>
</head>

<body>
  <h2>Exam Result for {{ $name }}</h2>
  <table>
    <thead>
      <tr>
        <th>Subject</th>
        <th>Total Questions</th>
        <th>Attempted</th>
        <th>Correct</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($scores as $score)
        <tr>
          <td>{{ $score['subject'] }}</td>
          <td>{{ $score['total'] }}</td>
          <td>{{ $score['attempted'] }}</td>
          <td>{{ $score['correct'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <p><strong>Grand Total:</strong> {{ $grandTotal }}</p>
  <p><strong>Correct Answers:</strong> {{ $grandCorrect }}</p>
</body>

</html>
