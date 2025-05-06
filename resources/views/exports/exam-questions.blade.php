<html>

<head></head>

<body>
  <table>
    <thead>
      <tr>
        <th>subject_id</th>
        <th>question</th>
        <th>a</th>
        <th>b</th>
        <th>c</th>
        <th>d</th>
        <th>answer</th>
        <th>illustration</th>
        <th>direction</th>
        <th>image</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($rows as $row)
        <tr>
          <td>{{ $row->subject_id }}</td>
          <td>{{ $row->question }}</td>
          <td>{{ $row->a }}</td>
          <td>{{ $row->b }}</td>
          <td>{{ $row->c }}</td>
          <td>{{ $row->d }}</td>
          <td>{{ $row->answer }}</td>
          <td>{{ $row->illustration }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->name }}</td>
          <td>{{ $row->name }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>
