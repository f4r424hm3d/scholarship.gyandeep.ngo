@php
@endphp
@extends('front.layouts.main')
@push('title')
  <title>Complete Profile - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container margin_60_35">
      <div class="main_title">
        <h1>Application Form</h1>
        <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
      </div>

      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
          </div>
          <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
          </div>
          <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
          </div>
          <div class="stepwizard-step">
            <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
          </div>
          <div class="stepwizard-step">
            <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
          </div>
        </div>
      </div>

      <form role="form">
        <div class="row setup-content" id="step-1">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-user-1"></i> Personal Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Candidate's First Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Your First Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Candidate's Middle Name</label>
                      <input type="text" class="form-control" placeholder="Enter Your Middle Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Candidate's Last Name</label>
                      <input type="text" class="form-control" placeholder="Enter Your Last Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father's Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Your Fathers Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father Occupation</label>
                      <input type="text" class="form-control" placeholder="Enter Father Occupation" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father Annual Income</label>
                      <input type="text" class="form-control" placeholder="Enter Father Annual Income" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mother's Name<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter Your Mother Name" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mother Occupation</label>
                      <input type="text" class="form-control" placeholder="Enter Mother Occupation" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Father Annual Income</label>
                      <input type="text" class="form-control" placeholder="Enter Mother Annual Income" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="Male">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Date of Birth<span class="text-danger">*</span></label>
                      <input type="date" class="form-control" placeholder="Date of Birth" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Category<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="Male">Select</option>
                        <option value="">SC/ST</option>
                        <option value="">OBC</option>
                        <option value="">Gernal</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Physically Handicaped</label>
                      <select class="form-control">
                        <option value="">YES</option>
                        <option value="" selected>NO</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nationality<span class="text-danger">*</span></label>
                      <select class="form-control selectpicker countrypicker" data-live-search="true"
                        placeholder="--Select--">
                        <option value="Male">Select Country</option>
                        <option value="india">India</option>
                        <option value="USA">USA</option>
                        <option value="Uk">Uk</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Aadhar Number/ National ID Number<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" placeholder="XXXX-XXXX-XXXX" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Passport Number</label>
                      <input type="text" class="form-control" placeholder="XXXX-XXXX-XXXX" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Passport Expiry Date</label>
                      <input type="date" class="form-control" placeholder="Date of Birth" />
                    </div>
                  </div>
                  <div class="col-md-2 col-6"></div>
                  <div class="col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-2" class="btn_1 medium w-100 nextBtn" type="button">
                      Next <i class="icon-right-thin"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row setup-content" id="step-2">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-edit"></i> Examination Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Select Level<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">UG</option>
                        <option value="">PG</option>
                        <option value="">P.hd</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Applying For<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">Engineering</option>
                        <option value="">Course Name Select Here</option>
                        <option value="">Course Name Select Here</option>
                        <option value="">Course Name Select Here</option>
                        <option value="">Course Name Select Here</option>
                        <option value="">Course Name Select Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Subject Group<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select Subject Group--</option>
                        <option value="">Subject Name Select</option>
                        <option value="">Subject Name Select</option>
                        <option value="">Subject Name Select</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Exam Date<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select Date</option>
                        <option value="">Select Date</option>
                        <option value="">Select Date</option>
                        <option value="">Select Date</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mode of Exam<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="" selected>Online</option>
                        <option value="">Offline</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Exam Center (Choice 1)<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Exam Center (Choice 2)<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Exam Center (Choice 3)<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                        <option value="">Select Choce</option>
                      </select>
                    </div>
                  </div>
                  <div></div>
                  <div class="col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-1" class="btn_1 medium w-100 nextBtn" type="button">
                      Back <i class="icon-left-thin"></i>
                    </button>
                  </div>
                  <div class="offset-md-8 col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-3" class="btn_1 medium w-100 nextBtn" type="button">
                      Next <i class="icon-right-thin"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row setup-content" id="step-3">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-book-open"></i> Academic's Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Class/Standard</label>
                      <input type="text" class="form-control" placeholder="10+2 or Equivalent" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Board/University</label>
                      <input type="text" class="form-control" placeholder="eg: CBSE" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Passing Year</label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Year Select Here</option>
                        <option value="">Year Select Here</option>
                        <option value="">Year Select Here</option>
                        <option value="">Year Select Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Maximum Marks</label>
                      <input type="text" class="form-control" placeholder="eg: 500" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Obtained Marks</label>
                      <input type="text" class="form-control" placeholder="eg: 423" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>% / Grade</label>
                      <input type="text" class="form-control" placeholder="eg: 10" />
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Class/Standard</label>
                      <input type="text" class="form-control" placeholder="10 or Equivalent" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Board/University</label>
                      <input type="text" class="form-control" placeholder="eg: RBSE" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Passing Year</label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Year Select Here</option>
                        <option value="">Year Select Here</option>
                        <option value="">Year Select Here</option>
                        <option value="">Year Select Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Maximum Marks</label>
                      <input type="text" class="form-control" placeholder="eg: 500" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Obtained Marks</label>
                      <input type="text" class="form-control" placeholder="eg: 423" />
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>% / Grade</label>
                      <input type="text" class="form-control" placeholder="eg: 42" />
                    </div>
                  </div>

                  <div></div>
                  <div class="col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-2" class="btn_1 medium w-100 nextBtn" type="button">
                      Back <i class="icon-left-thin"></i>
                    </button>
                  </div>
                  <div class="offset-md-8 col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-4" class="btn_1 medium w-100 nextBtn" type="button">
                      Next <i class="icon-right-thin"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row setup-content" id="step-4">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-upload"></i> Documents Upload
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Passport Size Photo<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Aadharcard/National ID Photo<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Driving Licence Photo</label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Passport Photo</label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-12 p-1"></div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>10th School Marksheet Photo<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>12th Marksheet Photo<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Graduation Marksheet Photo</label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Post Graduation Marksheet Photo</label>
                      <input type="file" class="form-control" placeholder="Ex: www.xyz.com" />
                    </div>
                  </div>
                  <div></div>
                  <div class="col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-3" class="btn_1 medium w-100 nextBtn" type="button">
                      Back <i class="icon-left-thin"></i>
                    </button>
                  </div>
                  <div class="offset-md-8 col-md-2 col-6 d-flex align-items-center">
                    <button href="#step-5" class="btn_1 medium w-100 nextBtn" type="button">
                      Next <i class="icon-right-thin"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row setup-content" id="step-5">
          <div class="col-xl-12 col-lg-12">
            <div class="pb-2">
              <div id="detail-title" style="padding-left: 15px">
                <i class="icon-location-outline"></i> Contact Details
              </div>
              <div class="box_general_3">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Mobile No.<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" placeholder="Enter Your Mobile No. Here" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Email<span class="text-danger">*</span></label>
                      <input type="email" class="form-control" placeholder="Enter Your Email Here" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Alternative Mobile No.<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" placeholder="Enter Your Alternative Mobile No." />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Parent's Mobile No.<span class="text-danger">*</span></label>
                      <input type="number" class="form-control" placeholder="Enter Your Parents Mobile No." />
                    </div>
                  </div>
                </div>

                <h5 class="mt-3">Present Address</h5>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>State<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select State Here</option>
                        <option value="">Select State Here</option>
                        <option value="">Select State Here</option>
                        <option value="">Select State Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>District<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select District Here</option>
                        <option value="">Select District Here</option>
                        <option value="">Select District Here</option>
                        <option value="">Select District Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Address<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="eg: 473/2, Shyam Nagar" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Pincode<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="250002" />
                    </div>
                  </div>
                </div>

                <h5 class="mt-3">Permanent Address</h5>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>State<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select State Here</option>
                        <option value="">Select State Here</option>
                        <option value="">Select State Here</option>
                        <option value="">Select State Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>District<span class="text-danger">*</span></label>
                      <select class="form-control">
                        <option value="">--Select--</option>
                        <option value="">Select District Here</option>
                        <option value="">Select District Here</option>
                        <option value="">Select District Here</option>
                        <option value="">Select District Here</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Address<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="eg: 473/2, Shyam Nagar" />
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Pincode<span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="250002" />
                    </div>
                  </div>
                  <p>
                    I do hereby declare that the above information is
                    correct and i shall abide by the terms & conditions of
                    the AIEESE (Secondary)
                  </p>
                  <div class="col-md-4 d-flex align-items-center">
                    <button class="btn_1 medium w-100 nextBtn" type="button">
                      Submit Information
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
@endsection
