@php
  use App\Models\LevelDocument;
  use App\Models\StudentDocuments;

  $ld = LevelDocument::with('getLevel')->whereIn('level_id', $leveldoc)->get();
  //printArray($ld->toArray());
@endphp
@extends('front.layouts.main')
@push('title')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Student Documents - Gyandeep NGO</title>
@endpush
@section('main-section')
  <main>
    <div class="container margin_60_35">
      <div class="main_title">
        <h1>Application Form</h1>
      </div>
      @include('front.student.application-form-steps')
      <div id="notification-div">

      </div>
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
      <div class="row setup-content" id="step-4">
        <div class="col-xl-12 col-lg-12">
          <div class="pb-2">
            <div id="detail-title" style="padding-left: 15px">
              <i class="icon-upload"></i> Documents Upload
            </div>
            <div class="box_general_3">
              @foreach ($ld as $ld)
                <form action="{{ url('scholarship/upload-documents') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="document_name" value="{{ $ld->getLevel->name }} {{ $ld->document_name }}">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="">{{ $ld->getLevel->name }} {{ $ld->document_name }}</label>
                        <input type="file" name="file" id="f{{ $ld->id }}"
                          onchange="checkSize('{{ $ld->id }}')" class="file" placeholder="Choose File">
                        <span class="text-danger" id="err{{ $ld->id }}"></span>
                        @error('file')
                          <span class="text-danger">
                            {{ $message }}
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-3">
                      <label for="">&nbsp;</label>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col-md-3">
                      @php
                        $dname = $ld->getLevel->name . ' ' . $ld->document_name;
                        $ldoc = StudentDocuments::where('document_name', '=', $dname)->get();
                      @endphp
                      @foreach ($ldoc as $ldoc)
                        <a href="{{ asset($ldoc->file_path) }}" target="_blank"
                          title="{{ $ldoc->document_name }}">file</a>
                      @endforeach
                    </div>
                  </div>
                </form>
              @endforeach
              <form action="{{ url('scholarship/upload-documents') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="document_name" value="Passport Size Photograph">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Passport Size Photograph</label>
                      <input type="file" name="file" id="fpsp" onchange="checkSize('psp')" class="file"
                        placeholder="Choose File">
                      <span class="text-danger" id="errpsp"></span>
                      @error('file')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-md-3">
                    @foreach ($psp as $psp)
                      <a href="{{ asset($psp->file_path) }}" target="_blank" title="{{ $psp->document_name }}">file</a>
                    @endforeach
                  </div>
                </div>
              </form>
              <form action="{{ url('scholarship/upload-documents') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="document_name" value="National Id">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">National Id / Aadhar</label>
                      <input type="file" name="file" id="fni" onchange="checkSize('ni')" class="file"
                        placeholder="Choose File">
                      <span class="text-danger" id="errni"></span>
                      @error('file')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-md-3">
                    @foreach ($nid as $nid)
                      <a href="{{ asset($nid->file_path) }}" target="_blank" title="{{ $nid->document_name }}">file</a>
                    @endforeach
                  </div>
                </div>
              </form>
              <form action="{{ url('scholarship/upload-documents') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="document_name" value="Passport">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Passport</label>
                      <input type="file" name="file" id="fp" onchange="checkSize('p')" class="file"
                        placeholder="Choose File">
                      <span class="text-danger" id="errp"></span>
                      @error('file')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-md-3">
                    @foreach ($pp as $pp)
                      <a href="{{ asset($pp->file_path) }}" target="_blank" title="{{ $pp->document_name }}">file</a>
                    @endforeach
                  </div>
                </div>
              </form>
              <form action="{{ url('scholarship/upload-documents') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="document_name" value="Cast Certificate">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Cast Certificate</label>
                      <input type="file" name="file" id="fcast" onchange="checkSize('cast')" class="file"
                        placeholder="Choose File">
                      <span class="text-danger" id="errcast"></span>
                      @error('file')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-md-3">
                    @foreach ($cast as $cast)
                      <a href="{{ asset($cast->file_path) }}" target="_blank"
                        title="{{ $cast->document_name }}">file</a>
                    @endforeach
                  </div>
                </div>
              </form>
              <form action="{{ url('scholarship/upload-documents') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="document_name" value="Income Certificate">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">Income Certificate</label>
                      <input type="file" name="file" id="fincome" onchange="checkSize('income')"
                        class="file" placeholder="Choose File">
                      <span class="text-danger" id="errincome"></span>
                      @error('file')
                        <span class="text-danger">
                          {{ $message }}
                        </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-md-3">
                    @foreach ($income as $income)
                      <a href="{{ asset($income->file_path) }}" target="_blank"
                        title="{{ $income->document_name }}">file</a>
                    @endforeach
                  </div>
                </div>
              </form>
              <div></div>
              <div class="offset-md-10 col-md-2 col-6 d-flex align-items-center">
                <a href="{{ url('profile/applied-scholarship') }}" class="btn_1 medium w-100">Proceed</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
    function checkSize(id) {
      $("#f" + id).css("border-color", "#F0F0F0");
      var file_size = $('#f' + id)[0].files[0].size;
      if (file_size > 1000000) {
        $("#err" + id).html(
          '<p>File should not be more than of 1 MB.</p>');
        $("#f" + id).css("border-color", "#FF0000");
        $("#f" + id).val("");
      } else {
        $("#err" + id).html('');
      }
    }
  </script>
@endsection
