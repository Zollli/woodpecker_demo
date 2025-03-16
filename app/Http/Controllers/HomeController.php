<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Recipe,App\Models\Inventory,App\Models\Sale,App\Models\Wholesale;

use Illuminate\Http\Request;

class HomeController extends Controller
{

  public function index(){

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

    return redirect('/');

  }

  public function showRecipes(){

    $glutenFree = Recipe::getRecord('glutenFree','1')->toArray();
    $lactoseFree = Recipe::getRecord('lactoseFree','1')->toArray();
    $glutenAndLactoseFree = Recipe::getGlutenAndLactoseFree()->toArray();

    return view('recipes.list', [
      'glutenFree' => $glutenFree,
      'lactoseFree' => $lactoseFree,
      'glutenAndLactoseFree' => $glutenAndLactoseFree
    ]);
  }

  public function showLastWeekProfit(){

    $salesOfLastWeek = Sale::getAll()->toArray();
    $salesRevenue = self::getSalesRevenue();
    $profit = self::getProfit($salesOfLastWeek,$salesRevenue);

    return view('profit.index', [
      'profit' => $profit
    ]);
  }

  public function maxCapacity(){

    $recipes = Recipe::getAll()->toArray();
    $inventory = Inventory::getAll()->toArray();
    $inventoryChangeUnit = [];
    $maxCapacity = [];

    foreach ($inventory as $item) {
      if (str_contains($item['amount'], 'pc')) {
        $inventoryChangeUnit[$item['name']] = intval($item['amount']);
      }else{
        $inventoryChangeUnit[$item['name']] = intval($item['amount']) * 1000;
      }
    }

    foreach ($recipes as $recipe) {

      foreach ($recipe['ingredients'] as $ingredient) {
        $maxCapacity[$recipe['name']][] = $inventoryChangeUnit[$ingredient['name']] / intval($ingredient['amount']);
      }
    }


    foreach ($maxCapacity as $key => $value) {
        $maxCapacity[$key]['min'] =  intval(min($value));
    }

    return view('maxcapacity.index', [
        'maxCapacity' => $maxCapacity
      ]);
  }

  public function nextOrderProfit(){

    $order = config('order.nextorder');
    $salesRevenue = self::getSalesRevenue();
    $profit = self::getProfit($order,$salesRevenue);

    return view('profit.nextorderprofit', [
      'profit' => $profit,
      'salesRevenue' => $salesRevenue,
      'order' => $order
    ]);

  }

  private function getSalesRevenue(){

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

  private function getProfit($order,$salesRevenue){
    $wholeSaleUnitPrice = [];
    $ingredientPrice = [];
    $total = 0;
    $wholeSalePrice = Wholesale::getall()->toArray();
    $recipes = Recipe::getAll()->toArray();

    foreach ($wholeSalePrice as $item) {
      if (str_contains($item['amount'], 'pc')) {
        $quantity = intval($item['amount']);
      }else{
        $quantity = intval($item['amount']) * 1000;
      }
      $price = intval($item['price']);
      $wholeSaleUnitPrice[$item['name']] = $price / $quantity;
    }

    foreach ($recipes as $recipe) {
      $totalRecipePrice = 0;
      foreach ($recipe['ingredients'] as $ingredient) {
        $totalRecipePrice += $wholeSaleUnitPrice[$ingredient['name']] * intval($ingredient['amount']);
      }
      $ingredientPrice[$recipe['name']] = $totalRecipePrice;
    }

    foreach ($order as $sale) {
      $total += $ingredientPrice[$sale['name']] * intval($sale['amount']);
    }

    return intval($salesRevenue - $total);
  }

}
