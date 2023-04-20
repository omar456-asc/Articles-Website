<?php
class HelperMethods
{
    public static function alert_massege($type, $message)
    {
        echo "<div class='alert alert-$type alert-dismissible text-white' role='alert'>";
        echo "<span class='text-sm'>$message</span>";
        echo " <button type='button' class='btn-close text-lg py-3 opacity-10' data-bs-dismiss='alert' aria-label='Close'>";
        echo " <span aria-hidden='true'>&times;</span>";
        echo "  </button>";
        echo "</div>";
    }

    public static function remember_input($input)
    {
        if (isset($_POST[$input]) && !empty($_POST[$input])) {
            return $_POST[$input];
        } else {
            return "";
        }
    }

    public static  function formatDate($date)
    {
        $date = getdate(strtotime($date));
        $date = [$date['mday'], $date['month'], $date['year']];
        $date = implode(", ", $date);
        return $date;
    }
}
