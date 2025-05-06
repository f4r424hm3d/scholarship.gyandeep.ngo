<div class="stepwizard">
  <div class="stepwizard-row setup-panel">
    <div class="stepwizard-step">
      <a href="javascript:void()" type="button"
        class="btn btn-{{ $step == 1 ? 'primary' : 'default' }} btn-circle">1</a>
    </div>
    <div class="stepwizard-step">
      <a href="javascript:void()" type="button" class="btn btn-{{ $step == 2 ? 'primary' : 'default' }} btn-circle"
        disabled="disabled">2</a>
    </div>
    <div class="stepwizard-step">
      <a href="javascript:void()" type="button" class="btn btn-{{ $step == 3 ? 'primary' : 'default' }} btn-circle"
        disabled="disabled">3</a>
    </div>
    <div class="stepwizard-step">
      <a href="javascript:void()" type="button" class="btn btn-{{ $step == 4 ? 'primary' : 'default' }} btn-circle"
        disabled="disabled">4</a>
    </div>
    <div class="stepwizard-step">
      <a href="javascript:void()" type="button" class="btn btn-{{ $step == 5 ? 'primary' : 'default' }} btn-circle"
        disabled="disabled">5</a>
    </div>
  </div>
</div>
