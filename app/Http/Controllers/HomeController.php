<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Recipe,App\Models\Inventory,App\Models\Sale,App\Models\Wholesale;

use Illuminate\Http\Request;

class HomeController extends Controller
{

  public function index(){

    // $recipes = Recipe::getAll()->toArray();
    // dd($recipes[0]['ingredients']);

    // $json_path = Storage::disk('data')->get('data.json');
    // $config_decoded = json_decode($json_path, true);
    // dd($config_decoded);


    $salesRevenue = self::getSalesRevenue();

    return view('main.index', [
        'salesRevenue' => $salesRevenue
    ]);
  }

  public function migrate(){

    $json_path = Storage::disk('data')->get('data.json');
    $json_decoded = json_decode($json_path, true);

    foreach ($json_decoded as $key=>$record) {
      if($key == 'recipes'){
        foreach ($record as $recipe) {
          $data = new Recipe;
          $data->name = $recipe['name'];
          $data->price = $recipe['price'];
          $data->lactoseFree = $recipe['lactoseFree'];
          $data->glutenFree = $recipe['glutenFree'];
          $data->ingredients = $recipe['ingredients'];
          $data->save();
        }
      }
      elseif ($key == 'inventory') {
        foreach ($record as $inventory) {
          $data = new Inventory;
          $data->name = $inventory['name'];
          $data->amount = $inventory['amount'];
          $data->save();
        }
      }
      elseif ($key == 'salesOfLastWeek') {
        foreach ($record as $sale) {
          $data = new Sale;
          $data->name = $sale['name'];
          $data->amount = $sale['amount'];
          $data->save();
        }
      }
      elseif ($key == 'wholesalePrices') {
        foreach ($record as $wholesale) {
          $data = new Wholesale;
          $data->name = $wholesale['name'];
          $data->amount = $wholesale['amount'];
          $data->price = $wholesale['price'];
          $data->save();
        }
      }
    }

  }

  public function getSalesRevenue(){

    $result = 0;
    $salesOfLastWeek = Sale::getAll()->toArray();
    $recipes = Recipe::getAll()->toArray();
    foreach ( $salesOfLastWeek as $key => $value) {
        $recipe = Recipe::getRecord('name',$value['name'])->toArray()[0];
        $price = intval($recipe['price']);
        $amount = intval($value['amount']);
        $result += $price * $amount;
    }

    return $result;
  }

}
