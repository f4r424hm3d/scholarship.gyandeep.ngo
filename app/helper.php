<?php
define('TO_EMAIL', 'studytutelage@gmail.com');
define('TO_NAME', 'Team tutelage Study');
define('CC_EMAIL', 'amanahlawat1918@gmail.com');
define('CC_NAME', 'Aman Ahlawat');
define('BCC_EMAIL', 'farazahmad280@gmail.com');
define('BCC_NAME', 'Mohd Faraz');

// define('TO_EMAIL', 'farazahmad280@gmail.com');
// define('TO_NAME', 'Mohd Faraz');
// define('CC_EMAIL', '4hm3df4r42@gmail.com');
// define('CC_NAME', 'Education Malaysia Education');
// ddefine('BCC_EMAIL', 'farazahmad280@gmail.com');
// define('BCC_NAME', 'Mohd Faraz');


if (!function_exists('printArray')) {
    function printArray($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}
if (!function_exists('getFormattedDate')) {
    function getFormattedDate($date, $formate)
    {
        return date($formate, strtotime($date));
    }
}
if (!function_exists('slugify')) {
    function slugify($text)
    {
        // Swap out Non "Letters" with a -
        $text = preg_replace('/[^\\pL\d]+/u', '-', $text);
        // Trim out extra -'s
        $text = trim($text, '-');
        // Convert letters that we have left to the closest ASCII representation
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // Make text lowercase
        $text = strtolower($text);
        // Strip out anything we haven't been able to convert
        $text = preg_replace('/[^-\w]+/', '', $text);
        return $text;
    }
}
if (!function_exists('dateDiff')) {
    function dateDiff($date1, $date2)
    {
        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        return $days_between = ceil(abs($date2_ts - $date1_ts) / 86400);
    }
}
if (!function_exists('avatar')) {
    function avatar($path, $gender)
    {
        if ($path != '') {
            $avatar = $path;
        } else {
            if ($gender == 'Male' || $gender == 'male') {
                $avatar = 'front/avatars/male.png';
            }
            if ($gender == 'Female' || $gender == 'female') {
                $avatar = 'front/avatars/female.png';
            }
            if ($gender == '' || is_null($gender)) {
                $avatar = 'front/avatars/default.png';
            }
        }
        return asset($avatar);
    }
}
if (!function_exists('aurl')) {
    function aurl($path = null)
    {
        $path = strtolower($path);
        if ($path != '') {
            return url('/admin/' . $path);
        } else {
            return url('/admin/');
        }
    }
}
if (!function_exists('uurl')) {
    function uurl($path = null)
    {
        $path = strtolower($path);
        if ($path != '') {
            return url('/user/' . $path);
        } else {
            return url('/user/');
        }
    }
}
