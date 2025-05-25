<div class="row">
  <div class="col-xl-12">
    <div class="card">
      <div class="card-header">
        <span style="float:left;">
          <a href="{{ aurl('student/' . $student->id) }}"
            class="btn btn-xs btn{{ $page_route == 'student' ? '' : '-outline' }} btn-info">Profile</a>

          <a href="{{ aurl('student-scholarship/' . $student->id) }}"
            class="btn btn-xs btn{{ $page_route == 'student-scholarship' ? '' : ' btn-outline' }} btn-info">Scholarship</a>

        </span>
      </div>
    </div>
  </div>
</div>
