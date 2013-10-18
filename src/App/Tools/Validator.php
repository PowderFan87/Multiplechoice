<?php
class App_Tools_Validator
{
    /**
     * validate string for email format
     *
     * @param string $strEmail
     * @return boolean
     */
    public static function isEmail($strEmail) {
        $strPattern = "/^(?:[[:alnum:]ßöäüÖÄÜ]{1})(?:[ßöäüÖÄÜ\w\-\.]*)@(?:[[:alnum:]ßöäüÖÄÜ]+[ßöäüÖÄÜ\w\-]*)\.(?:[a-z]{2,4}$|[ßöäüÖÄÜ\w\-]+\.[a-z]{2,4}$)/u";

        return self::isPattern($strEmail, $strPattern);
    }

    /**
     * Validate string to have a sertain length
     *
     * @param string $strValue
     * @param int $lngMax
     * @param int $lngMin
     * @return boolean
     */
    public static function hasStringlength($strValue, $lngMax, $lngMin = 0) {
        return (strlen($strValue) <= $lngMax && strlen($strValue) >= $lngMin);
    }

    /**
     * Check if value is not empty
     *
     * @param mixed $mixValue
     * @return boolean
     */
    public static function notEmpty($mixValue) {
        return !empty($mixValue);
    }

    /**
     * Check if values are equal
     *
     * @param mixed $mixValue1
     * @param mixed $mixValue2
     * @return boolean
     */
    public static function areEqual($mixValue1, $mixValue2) {
        return ($mixValue1 === $mixValue2);
    }

    /**
     * Check if string is valid username
     *
     * @param string $strUsername
     * @return boolean
     */
    public static function isValiduser($strUsername) {
        if(!self::isPattern($strUsername, "/^[[:alnum:]ßöäüÖÄÜ]{5,20}$/u")) {
            return false;
        }

        if(tblUser::getUserbystrusername($strUsername) !== false) {
            return false;
        }

        return true;
    }

    /**
     * Check if string matches given pattern
     *
     * @param string $strValue
     * @param string $strPattern
     * @return boolean
     */
    public static function isPattern($strValue, $strPattern) {
        return (preg_match($strPattern, $strValue) === 1);
    }

    public static function isLarger($lngValue, $lngMin) {
        return ($lngValue > $lngMin);
    }

    public static function hasEnoughanswers($arrAnswers) {
        foreach($arrAnswers as $lngKey => $arrAnswer) {
            if($arrAnswer['strAnswer'] == '') {
                unset($arrAnswers[$lngKey]);
            }
        }

        return (count($arrAnswers) >= 4);
    }

    public static function hasOnerightanswer($arrAnswers) {
        foreach($arrAnswers as $arrAnswer) {
            if($arrAnswer['strAnswer'] == '') {
                continue;
            }

            if(isset($arrAnswer['blnTrue']) && $arrAnswer['blnTrue'] == 'checked') {
                return true;
            }
        }

        return false;
    }
}