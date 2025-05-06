@extends('front.layouts.main')
@push('title')
  <title>Applied Test - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container-fluid margin_60_35">
      <div class="row">

        @include('front.student.profile-sidebar')

        <div class="col-xl-10 col-lg-10">
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
              <div class="row">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Scholarship</th>
                      <th>Exam Date</th>
                      <th>Time</th>
                      <th>Join Link</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($rows as $row)
                      <tr>
                        <td><b><a href="javascript:void()">{{ $row->getExamDet->getScholarship->name }}</a></b></td>
                        <td><b>{{ getFormattedDate($row->getExamDet->exam_date, 'd M Y') }}</b></td>
                        <td>
                          Start at - <b>{{ getFormattedDate($row->getExamDet->start_time, 'd M Y - h:i A') }}</b><br>
                          End at - <b>{{ getFormattedDate($row->getExamDet->end_time, 'd M Y - h:i A') }}</b><br>
                        </td>
                        <td>
                          @php
                            $current_time = date('Y-m-d H:i:s');
                            $start_time = getFormattedDate($row->getExamDet->start_time, 'd M Y - h:i A');
                            //$current_time = '2022-07-20 12:00:00';
                          @endphp
                          @if ($row->getApplication->payment_status == 'Success' || $row->getApplication->payment_status == 'Free')
                            @if ($current_time > $row->getExamDet->start_time && $current_time < $row->getExamDet->end_time)
                              <a onclick="window.open('{{ url('test/' . $row->getExamDet->token) }}','test','toolbars=0,width=100%,scrollbars=1');"
                                href="javascript:void()" href="" class="btn btn-sm btn-success">Join</a>
                            @elseif ($current_time > $row->getExamDet->end_time)
                              <span class='text-danger'>Exam expired</span>
                            @else
                              <a onclick="showMessage('{{ $start_time }}')" href="javascript:void()"
                                class="btn btn-sm btn-info">Join</a><br>
                              <span id="messSpan"></span>
                            @endif
                          @else
                            <a onclick="showMessage2()" href="javascript:void()" class="btn btn-sm btn-info">Join</a><br>
                            <span id="messSpan2"></span>
                          @endif

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
  </main>
  <script>
    function showMessage(time) {
      $('#messSpan').html('Exam will start on <b>' + time + '</b>.');
    }

    function showMessage2() {
      $('#messSpan2').html("<span class='text-danger'>Payment pending , You can't joined</span>");
    }

    function showMessage3() {
      $('#messSpan3').html("<span class='text-danger'>Exam expired</span>");
    }
  </script>
@endsection
