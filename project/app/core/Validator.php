<?php
class Validator
{
    public static function validate(mixed $data, string $rule): bool{
        $is_valid = match ($rule) {
            'alpha' => self::isAlpha($data),
            'email' => self::isEmail($data),
            'password' => self::isPassword($data),
            'date' => self::isDate($data),
            'url'=> self::isUrl($data),
            'phone' => self::isPhone($data),
            default => false
        };

        return $is_valid;
    }

    protected static function isAlpha(mixed $data) : bool{
        if(!is_string($data)) return false;
        return ctype_alpha($data);
    }

    protected static function isEmail(mixed $data) : bool{
        if(!is_string($data)) return false;
        return (bool)filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    protected static function isPassword(mixed $data) : bool{
        if(!is_string($data)) return false;
        return (bool)preg_match("#(?=^.{8,}$)((?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$#" ,$data);
    }

    /**
     * check format day, month, year with any delimeter
     */
    protected static function isDate(mixed $data) : bool{
        if(!is_string($data)) return false;
        $matches = [];
        preg_match_all('!\d+!', $data, $matches);
        if(!array_key_exists(0, $matches) && count($matches[0]) != 3) return false;
        $day = (int)$matches[0][0];
        $month =(int) $matches[0][1];
        $year = (int)$matches[0][2];
        if ($year === 0) $year = 2000;
        return checkdate($month, $day, $year);
    }

    protected static function isPhone(mixed $data) : bool{
        if(!is_string($data)) return false;
        if(!ctype_digit($data)) return false; 
        if(strlen($data) != 10) return false;
        return true;
    }

    protected static function isUrl(mixed $data) : bool{
        if(!is_string($data)) return false;
        if(strpos($data, '://') == false) {
            $data = "http://".$data;
        }
    
        return (bool)filter_var($data, FILTER_VALIDATE_URL);
    }
}