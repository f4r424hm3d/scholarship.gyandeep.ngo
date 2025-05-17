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
                 General Guidelines


                    <!--select class="form-control" style="width: 100px; float: right; margin-top: -7px"
                            aria-hidden="true">
                            <option selected="selected">English</option>
                            <option>Hindi</option>
                          </select-->
                  </h4>
                </div>

                <div id="ins" class="instrucations" >
                  <ul>
                  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Total Duration:</strong> 120 Minutes</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Total Marks:</strong> 100</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Question Type:</strong> Multiple Choice Questions (MCQs)</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Navigation:</strong> Use the "Save" and "Next" buttons to move through the questions</li>

  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Auto-Submission:</strong> The exam will automatically submit once the timer reaches zero.</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Timer:</strong> The countdown timer is server-based and cannot be paused or adjusted.</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Submission:</strong> No manual submission is required. The system will auto-submit your responses when the time ends.</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Mark for Review:</strong> You can mark any question for review and revisit it before final submission.</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Screen Monitoring:</strong> Your screen is under automatic recording for the duration of the exam.</li>
  <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 <strong>Academic Integrity:</strong> Any form of cheating or malpractice will lead to disqualification.</li>






                  </ul>

                  <!-- <ul>
                    <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 
                      <div class="b1"></div>
                      <p>You have answered the question.</p>
                    </li>
                    <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 
                      <div class="b2"></div>
                      <p>
                        You have visited but not answered the question yet.
                      </p>
                    </li>
                    <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 
                      <div class="b3"></div>
                      <p>
                        You have not answered the question but have marked
                        for review.
                      </p>
                    </li>
                    <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 
                      <div class="b4"><i class="fa fa-check"></i></div>
                      <p>
                        You have answered the question but have marked for
                        review.
                      </p>
                    </li>
                    <li> <i class="fa fa-chevron-right" aria-hidden="true"></i>
 
                      <div class="b5"></div>
                      <p>You have not visited the question yet.</p>
                    </li>
                  </ul> -->
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
