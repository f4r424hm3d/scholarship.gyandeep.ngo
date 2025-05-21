@php
  use App\Models\ExamQuestions;
@endphp
@extends('test.layouts.main')
@push('title')
  <title>Test Instruction - Gyandeep NGO</title>
@endpush
@section('main-section')
  <section class="content-wrapper py-5">
    <div class="container ">
      <section class="content">
        <div class="row">

          <div class="col-xl-10 mx-auto col-12">
            <div class="content-instructions">
                <div class="box">
              <div class="box-body pt-10 pb-1">
                <div class="mailbox-read-info">
                  <h4 class="mb-0">General Instructions:
                  </h4>
                </div>

                <div id="ins">
                  <!-- <p class="mt-15">Read the following instructions carefully.</p> -->
                  <!-- <div class="table-responsive mt-15">
                    <table class="table b-1 table-border-blue">
                      <thead class="table-bg-blue">
                        <tr>
                          <th>Sl No.</th>
                          <th>Section Name</th>
                          <th>No. of Question</th>
                          <th>Maximum Marks</th>
                          <th>Negative Marks</th>
                          <th>Positive Marks</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                          $i = 1;
                        @endphp
                        @foreach ($ei as $row)
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $row->getSubject->subject }}</td>
                            <td> {{ $row->noq }} </td>
                            <td> {{ $row->max_marks }} </td>
                            <td>{{ $row->n_marks }}</td>
                            <td>{{ $row->p_marks }}</td>
                          </tr>
                          @php
                            $i++;
                          @endphp
                        @endforeach
                      </tbody>
                    </table>
                  </div> -->

                  <!-- <ol class="mt-10 mb-0">
                    <li>Total duration of the examination is {{ $exam->duration }} Min</li>
                    <li>Your clock will be set at the server. The countdown timer at the to right corner of the screen
                      will display the remaining time available for you to complete the examination. When the timer
                      reaches zero, the examination will end by itself. You need not erminate the examination or submkit
                      your paper.</li>
                    <li>The Question Palette displayed on the right side of screen will show the status of each question
                      using on of the following symbols:</li>
                  </ol> -->
<ul class="main-start" >
                    <li>
                      <div class="b1 b-box"></div>
                      <p>You have answered the question.</p>
                    </li>
                    <li>
                      <div class="b2 b-box"></div>
                      <p>
                        You have visited but not answered the question yet.
                      </p>
                    </li>
                    <li>
                      <div class="b3 b-box"></div>
                      <p>
                        You have not answered the question but have marked
                        for review.
                      </p>
                    </li>
                    <li>
                      <div class="b4 b-box"><i class="fa fa-check"></i></div>
                      <p>
                        You have answered the question but have marked for
                        review.
                      </p>
                    </li>
                    <li>
                      <div class="b5 b-box"></div>
                      <p>You have not visited the question yet.</p>
                    </li>
                  </ul>
                </div>
              </div>

              <form action="{{ url('test/start-test') }}" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $exam->token }}">
                <div class="demo-checkbox" id="gins-note">
                  <!-- <p class="red">Please note all questions will appear in your default language. This language can be
                    changed for a particular question later on.</p> -->
                  <input type="checkbox" id="termcondition" name="termcondition" class="filled-in chk-col-success">
                  <label for="termcondition">I hereby confirm that I have read and understood all the exam instructions provided.

I agree to abide by the rules and regulations during the examination. I understand that any form of malpractice, including cheating or misuse of the platform, may lead to disqualification.</label>
                </div>

                <div class="box-footer">
                  <a href="{{ url('test/' . $exam->token . '/instruction') }}"><button type="button"
                      class="btn btn-light "><i class="ti-arrow-left mr-1"></i>Back</button></a>
                  <div class="pull-right">
                    <button id="nextBtn" type="button" class="btn btn-primary fw-bold">Next <i
                        class="ti-arrow-right ml-1"></i></button>
                  </div>
                </div>
              </form>
            </div>
            </div>
          

          </div>
        </div>
      <!-- </section> -->
    </div>
</section>
  <script>
    $(document).ready(function() {
      $('#termcondition').on('click', function() {
        if (this.checked) {
          //alert('hello');
          $('#nextBtn').attr('class', 'waves-effect waves-light btn btn-success');
          $('#nextBtn').attr('type', 'submit');
        } else {
          $('#nextBtn').attr('class', 'waves-effect waves-light btn btn-light');
          $('#nextBtn').attr('type', 'button');
        }
      });
    });

    function check() {
      var termcondition = $('#termcondition').val();
      alert(termcondition);
    }
  </script>
@endsection
