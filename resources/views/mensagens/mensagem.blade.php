@if(session('sucesso'))
  <div class="alert alert-success" role="alert" align="center" style="position:absolute; width:100%;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    {{session('sucesso')}}
  </div>
@endif
