@extends('layouts.app')
@section('content')

  <div class="mainContainer">
    <div class="row m-auto">
      <div class="col-12 pl-5 mt-4">
        <h2 class="mb-0">Az utolsó hét árbevétele:</h2>
        <p>{{$salesRevenue}} Ft</p>
      </div>
    </div>
  </div>

@endsection
