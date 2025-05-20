@extends('test.layouts.main')
@push('title')
  <title>Test Instruction - Gyandeep NGO</title>
@endpush
@section('main-section')
  <section class="content-wrapper py-5">
    <div class="container">
      <!-- <section class="content"> -->
        <div class="row">
          <div class="  col-xl-10 mx-auto col-12">
            <div class="content-instructions" >
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
                  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Total Duration:</strong></div>  120 Minutes</li>

  <li> <div class="d-flex  align-items-center"> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Total Marks:</strong></div>  100</li>
  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Question Type:</strong></div>   Multiple Choice Questions (MCQs)</li>
  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Navigation:</strong></div>   Use the "Save" and "Next" buttons to move through the questions</li>

  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Auto-Submission:</strong></div>   The exam will automatically submit once the timer reaches zero.</li>
  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Timer:</strong> </div>  The countdown timer is server-based and cannot be paused or adjusted.</li>
  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Submission:</strong></div>   No manual submission is required. The system will auto-submit your responses when the time ends.</li>
  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Mark for Review:</strong></div>   You can mark any question for review and revisit it before final submission.</li>
  <li> <div class="d-flex  align-items-center"><i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Screen Monitoring:</strong></div>   Your screen is under automatic recording for the duration of the exam.</li>
  <li> <div class="d-flex  align-items-center"> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 <strong>Academic Integrity:</strong></div>  Any form of cheating or malpractice will lead to disqualification.</li>






                  </ul>

                  <!-- <ul>
                    <li> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 
                      <div class="b1"></div>
                      <p>You have answered the question.</p>
                    </li>
                    <li> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 
                      <div class="b2"></div>
                      <p>
                        You have visited but not answered the question yet.
                      </p>
                    </li>
                    <li> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 
                      <div class="b3"></div>
                      <p>
                        You have not answered the question but have marked
                        for review.
                      </p>
                    </li>
                    <li> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 
                      <div class="b4"><i class="fa fa-check"></i></div>
                      <p>
                        You have answered the question but have marked for
                        review.
                      </p>
                    </li>
                    <li> <i class="fa fa-chevron-right mainrights mr-2 " aria-hidden="true"></i>
 
                      <div class="b5"></div>
                      <p>You have not visited the question yet.</p>
                    </li>
                  </ul> -->
                </div>


                
              </div>

              <div class="box-footer">
                <div class="pull-right">
                  <a href="{{ url('test/' . $exam->token . '/start-test') }}">
                    <button type="button" class="btn btn-primary">Next <i
                        class="ti-arrow-right"></i></button>
                  </a>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      <!-- </section> -->
    </div>
  </>
@endsection
