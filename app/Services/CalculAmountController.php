<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function App\View\Components\__construct;

class CalculAmountController extends Controller {
    private $request;

    public function __construct(?Request $request = null) {
        if($request){
            $this->request = $request;
        }
    }

    public function calculAmount(int $offer = null, int $size = null)  {
        $offer = (!empty($offer)) ? $offer : $this->request->query('offer', 1);
        $size = (!empty($size)) ? $size : $this->request->query('size', 10);

        if ($offer == 1) {
            $amount['M'] = 37.4;

            if ($size <= 100) {
                $amount['Y'] = $size * 0.2;
            } elseif ($size <= 1500 && $size > 100) {
                $amount['Y'] = $size * 0.18;
            } elseif ($size <= 3000 && $size > 1500) {
                $amount['Y'] = $size * 0.16;
            } elseif ($size > 3000) {
                $amount['Y'] = $size * 0.15;
            }

            if ($size <= 800) {
                $amount['M'] = $size * 0.01833;
            } elseif ($size <= 1500 && $size > 800) {
                $amount['M'] = $size * 0.01666;
            } elseif ($size <= 3000 && $size > 1500) {
                $amount['M'] = $size * 0.015;
            } elseif ($size > 3000) {
                $amount['M'] = $size * 0.0133;
            }

        } elseif ($offer == 2) {

            $amount['M'] = 64.6;

            if ($size <= 100) {
                $amount['Y'] = $size * 0.36;
            } elseif ($size <= 1500 && $size > 100) {
                $amount['Y'] = $size * 0.34;
            } elseif ($size <= 3000 && $size > 1500) {
                $amount['Y'] = $size * 0.30;
            } elseif ($size > 3000) {
                $amount['Y'] = $size * 0.29;
            }

            if ($size <= 800) {
                $amount['M'] = $size * 0.03166;
            } elseif ($size <= 1500 && $size > 800) {
                $amount['M'] = $size * 0.03;
            } elseif ($size <= 3000 && $size > 1500) {
                $amount['M'] = $size * 0.02833;
            } elseif ($size > 3000) {
                $amount['M'] = $size * 0.02666;
            }

        } elseif ($offer == 3) {

            $amount['M'] = 98.6;

            if ($size <= 100) {
                $amount['Y'] = $size * 0.56;
            } elseif ($size <= 1500 && $size > 100) {
                $amount['Y'] = $size * 0.54;
            } elseif ($size <= 3000 && $size > 1500) {
                $amount['Y'] = $size * 0.50;
            } elseif ($size > 3000) {
                $amount['Y'] = $size * 0.49;
            }

            if ($size <= 800) {
                $amount['M'] = $size * 0.04833;
            } elseif ($size <= 1500 && $size > 800) {
                $amount['M'] = $size * 0.04666;
            } elseif ($size <= 3000 && $size > 1500) {
                $amount['M'] = $size * 0.045;
            } elseif ($size > 3000) {
                $amount['M'] = $size * 0.04333;
            }


        } elseif ($offer == 4) {
            $amount['Y'] = 330;
            $amount['M'] = 30;
        }

        return $amount;

    }


}
