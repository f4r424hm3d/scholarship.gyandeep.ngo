<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Country Code</th>
      <th>Mobile</th>
      <th>Email</th>
      <th>City</th>
      <th>State</th>
      <th>Country</th>
      <th>Nationality</th>
      <th>Level</th>
      <th>Application Submitted</th>
      <th>Exam Attended</th>
      <th>Gender</th>
      <th>DOB</th>
      <th>First Language</th>
      <th>Marital Status</th>
      <th>Passport Number</th>
      <th>Passport Expiry Date</th>
      <th>Father Name</th>
      <th>Mother Name</th>
      <th>Parents Contact No.</th>
      <th>Parents Occupation</th>
      <th>Referred By</th>
      <th>Created At</th>
      <th>Exam</th>
      <th>Attempted</th>
      <th>Correct</th>
      <th>Accuracy (%)</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($rows as $student)
      @php
        $attempted = 0;
        $correct = 0;
        $accuracy = 0;
        $examTitle = 'N/A';

        if ($student->lastAttendedExam) {
            $examTitle = $student->lastAttendedExam->getExamDet->getScholarship->name ?? 'N/A';

            $answers = \App\Models\AnswerSheet::with('getAnswer')
                ->where('student_id', $student->id)
                ->where('exam_id', $student->lastAttendedExam->exam_id)
                ->where('answer', '!=', '')
                ->get();

            $attempted = $answers->count();
            $correct = $answers
                ->filter(function ($a) {
                    return $a->getAnswer && $a->answer === $a->getAnswer->answer;
                })
                ->count();
            $accuracy = $attempted > 0 ? round(($correct / $attempted) * 100, 2) : 0;
        }
      @endphp

      <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->c_code }}</td>
        <td>{{ $student->mobile }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->city }}</td>
        <td>{{ $student->state }}</td>
        <td>{{ $student->country }}</td>
        <td>{{ $student->nationality }}</td>
        <td>{{ $student->getLevel->name ?? '' }}</td>
        <td>{{ $student->submit_application ? 'Yes' : 'No' }}</td>
        <td>
          @if ($student->lastAttendedExam)
            {{ $student->lastAttendedExam->attended ? 'Yes' : 'No' }}
          @else
            No
          @endif
        </td>
        <td>{{ $student->gender }}</td>
        <td>{{ $student->dob }}</td>
        <td>{{ $student->first_language }}</td>
        <td>{{ $student->marital_status }}</td>
        <td>{{ $student->passport_number }}</td>
        <td>{{ $student->passport_expiry_date }}</td>
        <td>{{ $student->father_name }}</td>
        <td>{{ $student->mother_name }}</td>
        <td>{{ $student->parents_mobile }}</td>
        <td>{{ $student->parents_occupation }}</td>
        <td>{{ $student->referred_by }}</td>
        <td>{{ $student->created_at }}</td>
        <td>{{ $examTitle }}</td>
        <td>{{ $attempted }}</td>
        <td>{{ $correct }}</td>
        <td>{{ $accuracy }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
