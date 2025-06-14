<?php
namespace App\Utils;

class NumberUtil
{
    const CURRENCY = [
      'prefix'=> [
          'JPY' => '¥',
          'IDR' => 'Rp.',
          'USD' => '$'
      ],
      'wording' => [
        'JPY' => 'Yen',
        'IDR' => 'Rupiah',
        'USD' => 'Dollar'
      ]
    ];

    /**
    * currency converter.
    *
    * @param integer   $nominal    nominal
    * @param string    $currency   currency that wanted to print, default IDR
    * @param array     $options    optional params
    *
    * @return string   formatted nominal
    *
    */
    public static function currencyFormat($nominal, $currency = 'IDR', $options = [])
    {
        $defaultOptions = [
            'number_separator' => '.',
            'decimal_format' => ',',
            'decimal_place' => 0,
            'operator' => '',
            'round' => 'floor',
        ];
        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );

        if(isset($mergedOptions['round'])) {
            if ($mergedOptions['round'] == 'floor') {
                $nominal = floor($nominal);
            } else if ($mergedOptions['round'] == 'ceil') {
                $nominal = ceil($nominal);
            } else if ($mergedOptions['round'] == 'round') {
                $nominal = round($nominal);
            }
        }

        $nominal = self::numberFormat($nominal, $mergedOptions);
        $nominal = self::CURRENCY['prefix'][$currency].' '.$mergedOptions['operator'].' '.$nominal;

        return $nominal;
    }
    /**
     * number Formatter.
     *
     * @param integer   $nominal    nominal
     * @param array     $options    optional params
     *
     * @return string   formatted nominal
     *
     */

    public static function numberFormat($nominal, $options = [])
    {
        $defaultOptions = [
            'number_separator' => '.',
            'decimal_format' => ',',
            'decimal_place' => 0,
            'operator' => '',
        ];

        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );

        $nominal = number_format(
            $nominal,
            $mergedOptions['decimal_place'],
            $mergedOptions['decimal_format'],
            $mergedOptions['number_separator']
        );

        return $nominal;
    }

    public static function decimalFormat($nominal, $options = [])
    {
        $defaultOptions = [
            'number_separator' => '.',
            'decimal_format' => ',',
            'decimal_place' => 2,
            'operator' => '',
        ];

        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );

        $nominal = number_format(
            $nominal,
            $mergedOptions['decimal_place'],
            $mergedOptions['decimal_format'],
            $mergedOptions['number_separator']
        );

        return $nominal;
    }

    public static function numberToWord($nominal, $currency = 'JPY', $options = [])
    {
        $defaultOptions = [
        ];
        $mergedOptions = array_merge(
            $defaultOptions,
            $options
        );
        
        $wording = "";
        $wording = self::numberToWordRecursion($nominal);
        $wording .= " ".self::CURRENCY['wording'][$currency];
		return $wording;
    }

    public static function numberToWordRecursion($nominal)
    {
		$nominal = abs($nominal);
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		$wording = "";
		if ($nominal < 12) {
			$wording = " ". $huruf[$nominal];
		} else if ($nominal <20) {
			$wording = self::numberToWordRecursion($nominal - 10). " Belas";
		} else if ($nominal < 100) {
			$wording = self::numberToWordRecursion($nominal/10)." Puluh". self::numberToWordRecursion($nominal % 10);
		} else if ($nominal < 200) {
			$wording = " Seratus" . self::numberToWordRecursion($nominal - 100);
		} else if ($nominal < 1000) {
			$wording = self::numberToWordRecursion($nominal/100) . " Ratus" . self::numberToWordRecursion($nominal % 100);
		} else if ($nominal < 2000) {
			$wording = " Seribu" . self::numberToWordRecursion($nominal - 1000);
		} else if ($nominal < 1000000) {
			$wording = self::numberToWordRecursion($nominal/1000) . " Ribu" . self::numberToWordRecursion($nominal % 1000);
		} else if ($nominal < 1000000000) {
			$wording = self::numberToWordRecursion($nominal/1000000) . " Juta" . self::numberToWordRecursion($nominal % 1000000);
		} else if ($nominal < 1000000000000) {
			$wording = self::numberToWordRecursion($nominal/1000000000) . " Milyar" . self::numberToWordRecursion(fmod($nominal,1000000000));
		} else if ($nominal < 1000000000000000) {
			$wording = self::numberToWordRecursion($nominal/1000000000000) . " Trilyun" . self::numberToWordRecursion(fmod($nominal,1000000000000));
		} else if ($nominal < 1000000000000000000) {
			$wording = self::numberToWordRecursion($nominal/1000000000000000) . " Kuadriliun" . self::numberToWordRecursion(fmod($nominal,1000000000000000));
		}
        return $wording;
    }

}
