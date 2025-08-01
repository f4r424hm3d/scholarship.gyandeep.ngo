@php
  $ct = date('Y-m-d H:i:s');
  $ctp = strtotime(date('Y-m-d H:i:s'));
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Attended Test - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <section class="main-profile py-sm-5">
      <div class="container-fluid px-sm-5">
        <div class="row">

          @include('front.student.profile-sidebar')

          <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 mb-4">
            @if (session()->has('smsg'))
              <div class="alert alert-success alert-dismissable">
                {{ session()->get('smsg') }}
              </div>
            @endif
            @if (session()->has('emsg'))
              <div class="alert alert-danger alert-dismissable">
                {{ session()->get('emsg') }}
              </div>
            @endif
            <div style="clear:both"></div>
            <div class="pb-2">
              <div id="detail-title" style="padding-left:15px">scholarship Test</div>
              <div class="box_general_3">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Scholarship</th>
                        <th>Exam Date</th>
                        <th>Attended At</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($rows as $row)
                        @php
                          // echo $attended_tp = strtotime($row->attended_at);
                          // echo '<br>';
                          $end_time = strtotime($row->attended_at . '+' . $row->getExamDet->duration . ' minutes');
                        @endphp
                        <tr>
                          <td><b><a href="javascript:void()">{{ $row->getExamDet->getScholarship->name }}</a></b></td>
                          <td><b>{{ getFormattedDate($row->getExamDet->exam_date, 'd M Y') }}</b></td>
                          <td><b>{{ getFormattedDate($row->attended_at, 'd M Y  h:i A') }}</b></td>
                          <td>
                            @if ($row->submitted == 1 || $row->getExamDet->end_time < $ct || $end_time < $ctp)
                              <span @class(['text-success', 'font-bold' => true])>Submitted</span>
                            @else
                              <span @class(['text-primary', 'font-bold' => true])>Attending</span> <br>
                              <a onclick="openExamWindow('{{ url('test/' . $row->getExamDet->token) }}'); return false;"
                                href="#" class="btn btn-sm btn-success">Go to
                                Exam Panel</a>
                            @endif
                          </td>
                          <td>
                            <a href="{{ url('student/attended-test/' . $row->id) }}"
                              class="btn btn-sm btn-danger">View</a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
  <script>
    function openExamWindow(url) {
      const width = screen.availWidth;
      const height = screen.availHeight;

      window.open(
        url,
        'examWindow',
        `toolbar=0,scrollbars=1,resizable=1,top=0,left=0,width=${width},height=${height}`
      );
    }
  </script>
  <script>
    function showMessage(time) {
      $('#messSpan').html('Exam will start on <b>' + time + '</b>.');
    }

    function showMessage2() {
      $('#messSpan2').html("<span class='text-danger'>Payment pending , You can't joined</span>");
    }
  </script>
@endsection
