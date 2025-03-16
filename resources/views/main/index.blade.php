@extends('layouts.app')
@section('content')

  <div class="mainContainer">
    <div class="row m-auto pl-5 pt-4">
      <div class="col-12">
        <h2 class="mb-0">Az utolsó hét árbevétele:</h2>
        <p>{{$salesRevenue}} Ft</p>
      </div>
    </div>
  </div>

@endsection
