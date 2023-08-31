<?php

if (!function_exists("checkMethod")) {
    function checkMethod($value)
    {

        if ($_SERVER['REQUEST_METHOD'] == $value) {
            return true;
        } else {
            return false;
        }

    }
}
class userValidation
{

    static function notNull($value)
    {
        if (strlen($value) == 0) {
            return false;
        } else {
            return true;
        }
    }

    static function maxLength($value, $length)
    {
        if (strlen($value) < $length) {
            return true;
        } else {
            return false;
        }
    }


    static function minLength($value, $length)
    {
        if (strlen($value) > $length) {
            return true;
        } else {
            return false;
        }
    }
    static function emailValid($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {

            return false;
        }


    }




}

if (!function_exists("sanitize")) {
    function sanitize($value)
    {
        return trim(htmlentities(htmlspecialchars($value)));
    }
}





?>
<?php
if (!function_exists("displayError2")) {
    function displayError2($status, $name)
    { ?>
        <h2 class="text-danger">
            <?php
            if (isset($_SESSION[$status][$name])) {
                echo ($_SESSION[$status][$name]);
                unset($_SESSION[$status][$name]);
            }
            ?>
        </h2>
    <?php }
} ?>
<?php
if (!function_exists("displayError1")) {
    function displayError1($status)
    { ?>
        <h2 class="text-danger">
            <?php
            if (isset($_SESSION[$status])) {
                echo ($_SESSION[$status]);
                unset($_SESSION[$status]);
            }
            ?>
        </h2>
    <?php }
} ?>
<?php
if (!function_exists("success")) {
    function success($status, $massage)
    { ?>
        <h2 class="text-success">
            <?php
            if (isset($_SESSION[$status])) {
                echo $massage . " added successfully!";
                unset($_SESSION[$status]);
            }
            ?>
        </h2>
    <?php }
} ?>