<?php


class WUPPFormatter {

    private static $PERSIAN_BASE_K_YEAR = 1404;

    public static function jdate ($format, $timestamp = '', $none = '', $time_zone = 'Asia/Tehran', $tr_num = 'fa') {
        $T_sec = 0;
        if ($time_zone != 'local') date_default_timezone_set(($time_zone === '') ? 'Asia/Tehran' : $time_zone);
        $ts   = $T_sec + (($timestamp === '') ? time() : tr_num($timestamp));
        $date = explode('_', date('H_i_j_n_O_P_s_w_Y', $ts));
        list($j_y, $j_m, $j_d) = self::gregorian_to_jalali($date[8], $date[3], $date[2]);
        $doy = ($j_m < 7) ? (($j_m - 1) * 31) + $j_d - 1 : (($j_m - 7) * 30) + $j_d + 185;
        $kab = (((($j_y % 33) % 4) - 1) == ((int)(($j_y % 33) * 0.05))) ? 1 : 0;
        $sl  = strlen($format);
        $out = '';
        for ($i = 0; $i < $sl; $i++) {
            $sub = substr($format, $i, 1);
            if ($sub == '\\') {
                $out .= substr($format, ++$i, 1);
                continue;
            }
            switch ($sub) {

                case'E':
                case'R':
                case'x':
                case'X':
                    $out .= 'http://jdf.scr.ir';
                    break;

                case'B':
                case'e':
                case'g':
                case'G':
                case'h':
                case'I':
                case'T':
                case'u':
                case'Z':
                    $out .= date($sub, $ts);
                    break;

                case'a':
                    $out .= ($date[0] < 12) ? 'ق.ظ' : 'ب.ظ';
                    break;

                case'A':
                    $out .= ($date[0] < 12) ? 'قبل از ظهر' : 'بعد از ظهر';
                    break;

                case'b':
                    $out .= (int)($j_m / 3.1) + 1;
                    break;

                case'c':
                    $out .= $j_y . '/' . $j_m . '/' . $j_d . ' ،' . $date[0] . ':' . $date[1] . ':' . $date[6] . ' ' . $date[5];
                    break;

                case'C':
                    $out .= (int)(($j_y + 99) / 100);
                    break;

                case'd':
                    $out .= ($j_d < 10) ? '0' . $j_d : $j_d;
                    break;

                case'D':
                    $out .= self::jdate_words(array('kh' => $date[7]), ' ');
                    break;

                case'f':
                    $out .= self::jdate_words(array('ff' => $j_m), ' ');
                    break;

                case'F':
                    $out .= self::jdate_words(array('mm' => $j_m), ' ');
                    break;

                case'H':
                    $out .= $date[0];
                    break;

                case'i':
                    $out .= $date[1];
                    break;

                case'j':
                    $out .= $j_d;
                    break;

                case'J':
                    $out .= self::jdate_words(array('rr' => $j_d), ' ');
                    break;

                case'k';
                    $out .= self::to_persian_num(100 - (int)($doy / ($kab + 365) * 1000) / 10);
                    break;

                case'K':
                    $out .= self::to_persian_num((int)($doy / ($kab + 365) * 1000) / 10);
                    break;

                case'l':
                    $out .= self::jdate_words(array('rh' => $date[7]), ' ');
                    break;

                case'L':
                    $out .= $kab;
                    break;

                case'm':
                    $out .= ($j_m > 9) ? $j_m : '0' . $j_m;
                    break;

                case'M':
                    $out .= self::jdate_words(array('km' => $j_m), ' ');
                    break;

                case'n':
                    $out .= $j_m;
                    break;

                case'N':
                    $out .= $date[7] + 1;
                    break;

                case'o':
                    $jdw = ($date[7] == 6) ? 0 : $date[7] + 1;
                    $dny = 364 + $kab - $doy;
                    $out .= ($jdw > ($doy + 3) and $doy < 3) ? $j_y - 1 : (((3 - $dny) > $jdw and $dny < 3) ? $j_y + 1 : $j_y);
                    break;

                case'O':
                    $out .= $date[4];
                    break;

                case'p':
                    $out .= self::jdate_words(array('mb' => $j_m), ' ');
                    break;

                case'P':
                    $out .= $date[5];
                    break;

                case'q':
                    $out .= self::jdate_words(array('sh' => $j_y), ' ');
                    break;

                case'Q':
                    $out .= $kab + 364 - $doy;
                    break;

                case'r':
                    $key = self::jdate_words(array('rh' => $date[7], 'mm' => $j_m));
                    $out .= $date[0] . ':' . $date[1] . ':' . $date[6] . ' ' . $date[4] . ' ' . $key['rh'] . '، ' . $j_d . ' ' . $key['mm'] . ' ' . $j_y;
                    break;

                case's':
                    $out .= $date[6];
                    break;

                case'S':
                    $out .= 'ام';
                    break;

                case't':
                    $out .= ($j_m != 12) ? (31 - (int)($j_m / 6.5)) : ($kab + 29);
                    break;

                case'U':
                    $out .= $ts;
                    break;

                case'v':
                    $out .= self::jdate_words(array('ss' => ($j_y % 100)), ' ');
                    break;

                case'V':
                    $out .= self::jdate_words(array('ss' => $j_y), ' ');
                    break;

                case'w':
                    $out .= ($date[7] == 6) ? 0 : $date[7] + 1;
                    break;

                case'W':
                    $avs = (($date[7] == 6) ? 0 : $date[7] + 1) - ($doy % 7);
                    if ($avs < 0) $avs += 7;
                    $num = (int)(($doy + $avs) / 7);
                    if ($avs < 4) {
                        $num++;
                    }
                    elseif ($num < 1) {
                        $num = ($avs == 4 or $avs == ((((($j_y % 33) % 4) - 2) == ((int)(($j_y % 33) * 0.05))) ? 5 : 4)) ? 53 : 52;
                    }
                    $aks = $avs + $kab;
                    if ($aks == 7) $aks = 0;
                    $out .= (($kab + 363 - $doy) < $aks and $aks < 3) ? '01' : (($num < 10) ? '0' . $num : $num);
                    break;

                case'y':
                    $out .= substr($j_y, 2, 2);
                    break;

                case'Y':
                    $out .= $j_y;
                    break;

                case'z':
                    $out .= $doy;
                    break;

                default:
                    $out .= $sub;
            }
        }
        return ($tr_num != 'en') ? self::to_persian_num($out) : $out;
    }

    public static function jdate_words ($array, $mod = '') {
        foreach ($array as $type => $num) {
            $num = (int)tr_num($num);
            switch ($type) {

                case'ss':
                    $sl  = strlen($num);
                    $xy3 = substr($num, 2 - $sl, 1);
                    $h3  = $h34 = $h4 = '';
                    if ($xy3 == 1) {
                        $p34 = '';
                        $k34 = array('ده', 'یازده', 'دوازده', 'سیزده', 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده');
                        $h34 = $k34[substr($num, 2 - $sl, 2) - 10];
                    }
                    else {
                        $xy4 = substr($num, 3 - $sl, 1);
                        $p34 = ($xy3 == 0 or $xy4 == 0) ? '' : ' و ';
                        $k3  = array('', '', 'بیست', 'سی', 'چهل', 'پنجاه', 'شصت', 'هفتاد', 'هشتاد', 'نود');
                        $h3  = $k3[$xy3];
                        $k4  = array('', 'یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه');
                        $h4  = $k4[$xy4];
                    }
                    $array[$type] = (($num > 99) ? str_replace(array('12', '13', '14', '19', '20')
                                , array('هزار و دویست', 'هزار و سیصد', 'هزار و چهارصد', 'هزار و نهصد', 'دوهزار')
                                , substr($num, 0, 2)) . ((substr($num, 2, 2) == '00') ? '' : ' و ') : '') . $h3 . $p34 . $h34 . $h4;
                    break;

                case'mm':
                    $key          = array('فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند');
                    $array[$type] = $key[$num - 1];
                    break;

                case'rr':
                    $key          = array('یک', 'دو', 'سه', 'چهار', 'پنج', 'شش', 'هفت', 'هشت', 'نه', 'ده', 'یازده', 'دوازده', 'سیزده'
                                          , 'چهارده', 'پانزده', 'شانزده', 'هفده', 'هجده', 'نوزده', 'بیست', 'بیست و یک', 'بیست و دو', 'بیست و سه'
                                          , 'بیست و چهار', 'بیست و پنج', 'بیست و شش', 'بیست و هفت', 'بیست و هشت', 'بیست و نه', 'سی', 'سی و یک'
                    );
                    $array[$type] = $key[$num - 1];
                    break;

                case'rh':
                    $key          = array('یکشنبه', 'دوشنبه', 'سه شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه', 'شنبه');
                    $array[$type] = $key[$num];
                    break;

                case'sh':
                    $key          = array('مار', 'اسب', 'گوسفند', 'میمون', 'مرغ', 'سگ', 'خوک', 'موش', 'گاو', 'پلنگ', 'خرگوش', 'نهنگ');
                    $array[$type] = $key[$num % 12];
                    break;

                case'mb':
                    $key          = array('حمل', 'ثور', 'جوزا', 'سرطان', 'اسد', 'سنبله', 'میزان', 'عقرب', 'قوس', 'جدی', 'دلو', 'حوت');
                    $array[$type] = $key[$num - 1];
                    break;

                case'ff':
                    $key          = array('بهار', 'تابستان', 'پاییز', 'زمستان');
                    $array[$type] = $key[(int)($num / 3.1)];
                    break;

                case'km':
                    $key          = array('فر', 'ار', 'خر', 'تی‍', 'مر', 'شه‍', 'مه‍', 'آب‍', 'آذ', 'دی', 'به‍', 'اس‍');
                    $array[$type] = $key[$num - 1];
                    break;

                case'kh':
                    $key          = array('ی', 'د', 'س', 'چ', 'پ', 'ج', 'ش');
                    $array[$type] = $key[$num];
                    break;

                default:
                    $array[$type] = $num;
            }
        }
        return ($mod === '') ? $array : implode($mod, $array);
    }

    public static function to_persian_num ($value) {
        $persian_chars = [
            '1' => '۱',
            '2' => '۲',
            '3' => '۳',
            '4' => '۴',
            '5' => '۵',
            '6' => '۶',
            '7' => '۷',
            '8' => '۸',
            '9' => '۹',
            '0' => '۰'
        ];

        foreach ($persian_chars as $en_num => $fa_num) {
            $value = str_replace($en_num, $fa_num, $value);
        }

        return $value;
    }

    public static function to_jalali_date ($value) {
        $date      = explode('-', $value);
        $converted = self::gregorian_to_jalali(intval($date[0]), intval($date[1]), intval($date[2]));

        return Formatter::to_persian_num($converted[2]) . ' ' . self::get_month_name($converted[1]) . ' ' . Formatter::to_persian_num($converted[0]);
    }

    public static function gregorian_to_jalali ($gy, $gm, $gd, $mod = '') {
        $g_d_m = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
        if ($gy > 1600) {
            $jy = 979;
            $gy -= 1600;
        }
        else {
            $jy = 0;
            $gy -= 621;
        }
        $gy2  = ($gm > 2) ? ($gy + 1) : $gy;
        $days = (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) - 80 + $gd + $g_d_m[$gm - 1];
        $jy   += 33 * ((int)($days / 12053));
        $days %= 12053;
        $jy   += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy   += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        $jm = ($days < 186) ? 1 + (int)($days / 31) : 7 + (int)(($days - 186) / 30);
        $jd = 1 + (($days < 186) ? ($days % 31) : (($days - 186) % 30));

        return ($mod == '') ? array($jy, $jm, $jd) : $jy . $mod . $jm . $mod . $jd;
    }

    public static function jalali_to_gregorian ($jy, $jm, $jd, $mod = '') {
        list($jy, $jm, $jd) = explode('_', $jy . '_' . $jm . '_' . $jd);/* <= Extra :اين سطر ، جزء تابع اصلي نيست */
        if ($jy > 979) {
            $gy = 1600;
            $jy -= 979;
        }
        else {
            $gy = 621;
        }
        $days = (365 * $jy) + (((int)($jy / 33)) * 8) + ((int)((($jy % 33) + 3) / 4)) + 78 + $jd + (($jm < 7) ? ($jm - 1) * 31 : (($jm - 7) * 30) + 186);
        $gy   += 400 * ((int)($days / 146097));
        $days %= 146097;
        if ($days > 36524) {
            $gy   += 100 * ((int)(--$days / 36524));
            $days %= 36524;
            if ($days >= 365) {
                $days++;
            }
        }
        $gy   += 4 * ((int)(($days) / 1461));
        $days %= 1461;
        $gy   += (int)(($days - 1) / 365);
        if ($days > 365) {
            $days = ($days - 1) % 365;
        }
        $gd = $days + 1;
        foreach (
            array(
                0,
                31,
                ((($gy % 4 == 0) and ($gy % 100 != 0)) or ($gy % 400 == 0)) ? 29 : 28,
                31,
                30,
                31,
                30,
                31,
                31,
                30,
                31,
                30,
                31
            ) as $gm => $v
        ) {
            if ($gd <= $v) {
                break;
            }
            $gd -= $v;
        }

        return ($mod === '') ? array($gy, $gm, $gd) : $gy . $mod . $gm . $mod . $gd;
    }

    private static function get_month_name ($month) {
        switch ((int)$month) {
            case 1:
                return 'فروردین';
            case 2:
                return 'اردیبهشت';
            case 3:
                return 'خرداد';
            case 4:
                return 'تیر';
            case 5:
                return 'مرداد';
            case 6:
                return 'شهریور';
            case 7:
                return 'مهر';
            case 8:
                return 'آبان';
            case 9:
                return 'آذر';
            case 10:
                return 'دی';
            case 11:
                return 'بهمن';
            case 12:
                return 'اسفند';
            default:
                return 'ناشناخته';
        }
    }

    public static function get_month_day_length (int $year, int $month) {
        switch ($month) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return 31;
            case 7:
            case 8:
            case 9:
            case 10:
            case 11:
                return 30;
            case 12:
                return self::isPersianKYear($year) ? 30 : 29;
            default:
                return null;
        }
    }

    private static function isPersianKYear (int $year) {
        if ($year >= self::$PERSIAN_BASE_K_YEAR) {
            return self::checkUpPersianKYear($year);
        }
        else {
            return self::checkDownPersianKYear($year);
        }
    }

    private static function checkUpPersianKYear (int $persianYear) {
        $isAddedYear = self::$PERSIAN_BASE_K_YEAR;
        $count       = 1;
        do {
            if ($persianYear == $isAddedYear || $persianYear == self::$PERSIAN_BASE_K_YEAR) {
                return true;
            }
            if ($count == 8) {
                $isAddedYear += 1;
                $count       = 1;
            }
            else {
                $count++;
            }
            $isAddedYear += 4;
            if ($persianYear == $isAddedYear || $persianYear == self::$PERSIAN_BASE_K_YEAR) {
                return true;
            }
        } while ($persianYear > $isAddedYear);

        return false;
    }

    private static function checkDownPersianKYear (int $persianYear) {
        $isAddedYear = self::$PERSIAN_BASE_K_YEAR - 1;
        $count       = 1;
        do {
            if ($persianYear == $isAddedYear || $persianYear == self::$PERSIAN_BASE_K_YEAR) {
                return true;
            }
            if ($count == 8) {
                $isAddedYear -= 1;
                $count       = 1;
            }
            else {
                $count++;
            }
            $isAddedYear -= 4;

            if ($persianYear == $isAddedYear || $persianYear == self::$PERSIAN_BASE_K_YEAR) {
                return true;
            }
        } while ($persianYear < $isAddedYear);

        return false;
    }

    public static function convert_to_search_date ($persian_date) {
        $date   = explode('-', $persian_date);
        $e_date = self::jalali_to_gregorian($date[0], $date[1], $date[2]);

        return $e_date[0] . '-' . $e_date[1] . '-' . $e_date[2];
    }

    public static function to_jalali_date_ ($date) {
        $year  = substr($date, 0, 4);
        $month = substr($date, 4, 6);
        $day   = substr($date, 6, 8);

        return self::to_jalali_date($year . '-' . $month . '-' . $day);
    }

    public static function get_month_persian_name($month)
    {
        switch ($month){
            case 1:return __('فروردین', 'user-panel-pro');
            case 2:return __('اردیبهشت', 'user-panel-pro');
            case 3:return __('خرداد', 'user-panel-pro');
            case 4:return __('تیر', 'user-panel-pro');
            case 5:return __('مرداد', 'user-panel-pro');
            case 6:return __('شهریور', 'user-panel-pro');
            case 7:return __('مهر', 'user-panel-pro');
            case 8:return __('آبان', 'user-panel-pro');
            case 9:return __('آذر', 'user-panel-pro');
            case 10:return __('دی', 'user-panel-pro');
            case 11:return __('بهمن', 'user-panel-pro');
            case 12:return __('اسفند', 'user-panel-pro');
            default:return __('unknown', 'user-panel-pro');
        }
    }
}