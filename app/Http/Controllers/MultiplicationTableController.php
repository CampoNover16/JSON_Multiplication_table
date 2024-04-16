<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MultiplicationTableController extends Controller
{
    private function makeTable($number)
    {
        $number = intval($number);

        if (!is_int($number)) {
            throw new \InvalidArgumentException('Input must be an integer.');
        }
        
        $array = [];

        for($i=1;$i<=$number;$i++){
            for($j=1;$j<=$number;$j++){
                $array[$i][$j] = $i*$j;
            };
        }

        return $array;
    }

    public function show(Request $request, $number)
    {
        if (!is_numeric($number) || !($number >= 1 && $number <= 100)) {
            return response()->json(['error' => 'Given value is not a number from range 1-100'], 422);
        }

        $cacheKey = 'table_' . $number;

        if(Cache::has($cacheKey)){
            $result = Cache::get($cacheKey);
        }else{
            $result = $this->makeTable($number);
            Cache::add($cacheKey, $result);
        }

        return response()->json($result);
    }
}
