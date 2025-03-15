@extends('layouts.app')
@section('content')

    <div class="mainContainer">
      <div class="row m-auto">
        <div class="col-4">
          <h2>Gluténmentes termékek</h2>
            <ul>
              @foreach($glutenFree as $item)
                <li>{{$item['name'].' - '.$item['price']}}</li>
              @endforeach
            </ul>
        </div>
        <div class="col-4">
          <h2>Laktózmentes termékek</h2>
          <ul>
            @foreach($lactoseFree as $item)
              <li>{{$item['name'].' - '.$item['price']}}</li>
            @endforeach
          </ul>
        </div>
        <div class="col-4">
          <h2>Glutén- és laktózmentes termékek</h2>
          <ul>
            @foreach($glutenAndLactoseFree as $item)
              <li>{{$item['name'].' - '.$item['price']}}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>





@endsection
