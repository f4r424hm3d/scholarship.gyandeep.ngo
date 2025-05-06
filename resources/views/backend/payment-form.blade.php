<div class="modal fade" id="paymentFormModel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Submit Payment Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <form id="" action="{{ url('admin/applications/submit-payment') }}" method="post"
                  enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" id="payment_application_id" name="application_id" value="">
                  <input type="hidden" id="payment_student_id" name="student_id" value="">
                  <div class="step">
                    <div class="form-group">
                      <label>Name of Account holder <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" id="from" name="from" placeholder="Jhon Doe"
                        value="{{ old('from') }}">
                      <span class="text-danger">
                        @error('from')
                          {{ $message }}
                        @enderror
                      </span>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Amount <span class="text-danger">*</span></label>
                          <input type="text" id="amount" name="amount" class="form-control"
                            placeholder="Enter Amount" value="{{ old('amount') }}">
                          <span class="text-danger">
                            @error('amount')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label>Transaction Id <span class="text-danger">*</span></label>
                          <input type="text" id="transaction_id" name="transaction_id" class="form-control"
                            placeholder="Enter Transaction Id" value="{{ old('transaction_id') }}">
                          <span class="text-danger">
                            @error('transaction_id')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Payment Date <span class="text-danger">*</span></label>
                          <input type="date" id="payment_date" name="payment_date" class="form-control"
                            placeholder="Enter Payment Date" value="{{ old('payment_date') }}">
                          <span class="text-danger">
                            @error('payment_date')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Payment Through <span class="text-danger">*</span></label>
                          <input type="text" id="payment_through" name="payment_through" class="form-control"
                            placeholder="Eg: UPI , Bank Transafer" value="{{ old('payment_through') }}">
                          <span class="text-danger">
                            @error('payment_through')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Upload Payment Receipt </label>
                          <input type="file" id="payment_receipt" name="payment_receipt" class="form-control"
                            placeholder="Enter Payment Date" value="{{ old('payment_receipt') }}">
                          <span class="text-danger">
                            @error('payment_receipt')
                              {{ $message }}
                            @enderror
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="">
                        <button class="btn btn-primary" type="submit" id="">Save</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
