@extends('layouts.app')
@section('content')

    <div class="mainContainer">
      <div class="row m-auto pl-5 pr-5 pt-4">
        <div class="col-12 col-lg-4">
          <h2>Gluténmentes termékek</h2>
            <ul>
              @foreach($glutenFree as $item)
                <li>{{$item['name'].' - '.$item['price']}}</li>
              @endforeach
            </ul>
        </div>
        <div class="col-12 col-lg-4">
          <h2>Laktózmentes termékek</h2>
          <ul>
            @foreach($lactoseFree as $item)
              <li>{{$item['name'].' - '.$item['price']}}</li>
            @endforeach
          </ul>
        </div>
        <div class="col-12 col-lg-4">
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
