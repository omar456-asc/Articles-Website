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
    public static function upload_file($file, $path)
    {
        $target_file = $path . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            return "File is not an image.";
            $uploadOk = 0;
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            return "Sorry, file already exists.";
            $uploadOk = 0;
        }
        // Check file size
        if ($file["size"] > 3000000) {
            return "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return "The file " . basename($file["name"]) . " has been uploaded.";
            } else {
                return "Sorry, there was an error uploading your file.";
            }
        }
    }
    public static  function isActiveLink($title, $pageTitle)
    {
        if ($title == $pageTitle) {
            return "active bg-gradient-primary";
        }
    }
}
