<?php
/**
 * @description - function for encryptng plain text to cipher text.
 * @param $plain_text - plain text to encrypt
 */
function doEncrypt($plain_text){
    //Note : This algorithm and function is for demo you can use by your own logic, salt and algorithm.
    return hash('sha256', $plain_text);
}
?>