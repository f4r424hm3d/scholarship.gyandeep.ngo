@extends('test.layouts.main')
@push('title')
  <title>Test Instruction - Gyandeep NGO</title>
@endpush
@section('main-section')
  <div class="content-wrapper">
    <div class="container-full">
      <section class="content">
        <div class="row">
          <div class="col-xl-10 col-12">
            <div class="new-heading">INSTRUCTIONS</div>
            <div class="box">
              <div class="box-body pt-10">
                <div class="mailbox-read-info">
                  <h4 class="mb-0">
                    General Instructions:

                    <!--select class="form-control" style="width: 100px; float: right; margin-top: -7px"
                            aria-hidden="true">
                            <option selected="selected">English</option>
                            <option>Hindi</option>
                          </select-->
                  </h4>
                </div>

                <div id="ins">
                  <ol>
                    <li>Total duration of the examination is 50 Min</li>
                    <li>
                      Your clock will be set at the server. The countdown
                      timer at the to right corner of the screen will
                      display the remaining time available for you to
                      complete the examination. When the timer reaches zero,
                      the examination will end by itself. You need not
                      erminate the examination or submkit your paper.
                    </li>
                    <li>
                      The Question Palette displayed on the right side of
                      screen will show the status of each question using on
                      of the following symbols:
                    </li>
                  </ol>

                  <ul>
                    <li>
                      <div class="b1"></div>
                      <p>You have answered the question.</p>
                    </li>
                    <li>
                      <div class="b2"></div>
                      <p>
                        You have visited but not answered the question yet.
                      </p>
                    </li>
                    <li>
                      <div class="b3"></div>
                      <p>
                        You have not answered the question but have marked
                        for review.
                      </p>
                    </li>
                    <li>
                      <div class="b4"><i class="fa fa-check"></i></div>
                      <p>
                        You have answered the question but have marked for
                        review.
                      </p>
                    </li>
                    <li>
                      <div class="b5"></div>
                      <p>You have not visited the question yet.</p>
                    </li>
                  </ul>
                </div>
              </div>

              <div class="box-footer">
                <div class="pull-right">
                  <a href="{{ url('test/' . $exam->token . '/start-test') }}">
                    <button type="button" class="waves-effect waves-light btn btn-light">Next <i
                        class="ti-arrow-right"></i></button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection
