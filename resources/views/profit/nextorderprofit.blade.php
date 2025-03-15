@extends('layouts.app')
@section('content')

<div class="mainContainer">
    <div class="row m-auto pl-5 pt-4">
      <div class="col-12">
        <h2>Rendelés adatai:</h2>
        <ul>
          @foreach($order as $item)
          <li>{{$item['name'].' : '.$item['amount'].' db'}}</li>
        @endforeach
        </ul>
        <h2 class="mb-0">Rendelés anyagköltsége:</h2>
        <p>{{$salesRevenue.' Ft' ?? ''}}</p>
        <h2 class="mb-0">Rendelés profitja:</h2>
        <p>{{$profit.' Ft' ?? ''}}</p>
      </div>
    </div>
  </div>

@endsection
