@php
  $c_url = request()->path();
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Applications - Gyandeep NGO</title>
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
              <div id="detail-title" style="padding-left:15px">
                <i class="icon-info-circled"></i> Applications
              </div>
              <div class="box_general_3">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Scholarship</th>
                        <th>Applied For</th>
                        <th>Exam Detail</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($as as $as)
                        <tr>
                          <td>
                            {{ $as->getScholarship->name }}
                          </td>
                          <td>
                            Category - <b>{{ $as->getExam->getCourseCategory->category ?? '' }}</b><br>
                          </td>
                          <td>
                            @if ($as->getAsignExam->attended == 1 && $as->getAsignExam->submitted == 1)
                              <span class="text-success">Exam Attended</span><br>
                            @else
                              Start at - <b>{{ getFormattedDate($as->getExam->start_time, 'd M Y - h:i A') }}</b><br>
                              End at - <b>{{ getFormattedDate($as->getExam->end_time, 'd M Y - h:i A') }}</b><br>
                              @php
                                $current_time = date('Y-m-d H:i:s');
                                $start_time = getFormattedDate($as->getExam->start_time, 'd M Y - h:i A');
                                //$current_time = '2022-07-20 12:00:00';
                              @endphp
                              @if ($current_time >= $as->getExam->start_time && $current_time < $as->getExam->end_time)
                                {{-- <a onclick="window.open('{{ url('test/' . $as->getExam->token) }}','test','toolbars=0,width=100%,scrollbars=1');"
                                  href="javascript:void()" class="btn btn-sm btn-success">Start Exam</a> --}}
                                {{-- <a onclick="window.open('{{ url('test/' . $as->getExam->token) }}', 'test', 'toolbar=0,scrollbars=1,resizable=1,width=' + screen.availWidth + ',height=' + screen.availHeight); return false;"
                                  href="javascript:void(0)" class="btn btn-sm btn-success">Start Exam</a> --}}
                                <a onclick="openExamWindow('{{ url('test/' . $as->getExam->token) }}'); return false;"
                                  href="#" class="btn btn-sm btn-success">Start Exam</a>

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
                              @elseif ($current_time > $as->getExam->end_time)
                                <span class='text-danger'>Exam expired</span>
                              @else
                                <a onclick="showMessage('{{ $start_time }}')" href="javascript:void()"
                                  class="btn btn-sm btn-info">Start Exam</a><br>
                                <span id="messSpan"></span>
                              @endif
                            @endif
                          </td>
                          <td>
                            @if ($as->getAsignExam->attended == 1 && $as->getAsignExam->submitted == 1)
                              <span class="text-success">Completed</span>
                            @else
                              <span class="text-danger">Pending</span>
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
    </section>
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
