<?php 

namespace Wingnut\Explain;

final class Json {
    private static $codes = [
        'JSON_ERROR_NONE' => 'No error has occurred',
        'JSON_ERROR_DEPTH' => 'The maximum stack depth has been exceeded',
        'JSON_ERROR_STATE_MISMATCH' => 'Invalid or malformed JSON',
        'JSON_ERROR_CTRL_CHAR' => 'Control character error, possibly incorrectly encoded',
        'JSON_ERROR_SYNTAX' => 'Syntax error',
        'JSON_ERROR_UTF8' => 'Malformed UTF-8 characters, possibly incorrectly encoded',
        'JSON_ERROR_RECURSION' => 'One or more recursive references in the value to be encoded',
        'JSON_ERROR_INF_OR_NAN' => 'One or more NAN or INF values in the value to be encoded',
        'JSON_ERROR_UNSUPPORTED_TYPE' => 'A value of a type that cannot be encoded was given'
    ];
 
    public static function mapError($code) {
        foreach(self::$codes as $constant => $message) {
            if($code === constant($constant)) {
                return $message;
            }
        }
        
        return 'Unknown error';
    }   
}