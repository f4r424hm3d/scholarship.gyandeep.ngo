<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 " style="margin-bottom: -1.5rem;">
  <div class="box">
    <div class="box-header">
      <h4 class="mb-sm-0 font-size-18" style="float:left">{{ $page_title }} <span
          class="text-danger">({{ $student->name }})</span>
      </h4>
      <span style="float:right;">
        <a href="{{ url($role . '/student/' . $student->id . '/profile') }}"
          class="btn btn-xs btn{{ $page_route == 'profile' ? '' : '-outline' }} btn-info">Profile</a>

        <a href="{{ url($role . '/student/' . $student->id . '/scholarship') }}"
          class="btn btn-xs btn{{ $page_route == 'scholarship' ? '' : ' btn-outline' }} btn-info">Scholarship</a>

        <a href="{{ url($role . '/student/' . $student->id . '/exams') }}"
          class="btn btn-xs btn{{ $page_route == 'exams' ? '' : ' btn-outline' }} btn-info">Exams</a>

      </span>
    </div>
  </div>
</div>
