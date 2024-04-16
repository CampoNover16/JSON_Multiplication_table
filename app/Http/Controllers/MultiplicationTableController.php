<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MultiplicationTableController extends Controller
{
    private function makeTable($number)
    {
        $number = intval($number);
        
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
        $result = $this->makeTable($number);

        return response()->json($result);
    }
}
