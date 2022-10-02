<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CalculAmountController extends Controller {
    private $request;

    public function __construct(?Request $request = null) {
        if($request){
            $this->request = $request;
        }
    }

    public function calculAmount(string $offer = null, int $size = null, bool $isFreeTrial = false)  {
        $offer = (!empty($offer)) ? $offer : $this->request->query('offer', 'standard');
        $size = (!empty($size)) ? $size : $this->request->query('size', 10);

        if ($offer == 'basique') {
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

        } elseif ($offer == 'standard') {

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

            if($isFreeTrial == true) {
                $amount['Y'] = 0;
                $amount['M'] = 0;
            }

        } elseif ($offer == 'entreprise') {

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

        } elseif ($offer == 'dédié') {
            switch ($size) {
                case 500:
                    $amount['Y'] = 220;
                    $amount['M'] = 20;
                    break;
                case 1500:
                    $amount['Y'] = 325;
                    $amount['M'] = 30;
                    break;
                case 3000:
                    $amount['Y'] = 435;
                    $amount['M'] = 40;
                    break;
                case 5000:
                    $amount['Y'] = 485;
                    $amount['M'] = 45;
                    break;
                default:
                    $amount['Y'] = 220;
                    $amount['M'] = 20;
                    break;
            }
        }

        $amount = array_map(function($v){
        $v = round($v, 2);
        return $v;
        }, $amount);
        return $amount;
    }

    public function roundAmount($v) {
        $v = number_format($v, 2);
        return $v;
    }
}
