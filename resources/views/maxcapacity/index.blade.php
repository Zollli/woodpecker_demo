@extends('layouts.app')
@section('content')

  <div class="mainContainer">
    <div class="row m-auto pl-5 pt-4">
      <div class="col-12">
        <h2>Maximum legyártható mennyiség a jelenlegi készletből:</h2>
        <ul>
          @foreach($maxCapacity as $key => $item)
            <li>{{$key.' - '.$item['min'].' db'}}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

@endsection
