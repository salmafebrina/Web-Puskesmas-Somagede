<?php

namespace App\Http\Controllers;

use App\Models\Icd10;
use Illuminate\Http\Request;

class Icd10Controller extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->q;

        $icd10 = Icd10::where('code_icd', 'like', "%{$keyword}%")
            ->orWhere('display', 'like', "%{$keyword}%")
            ->limit(20)
            ->get();

        return response()->json(
            $icd10->map(function ($item) {

                return [
                    'id'   => $item->code_icd,
                    'text' => $item->code_icd.' - '.$item->display,
                    'display' => $item->display,
                ];

            })
        );
    }
}