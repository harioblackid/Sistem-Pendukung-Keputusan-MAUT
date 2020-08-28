<?php

$uri = $_SERVER['REQUEST_URI'];
$pageurl = explode("/", $_SERVER['REQUEST_URI']);;

    // Setting for Hosting
	// $base_url = "http://" . $_SERVER['HTTP_HOST'];
	// (isset($pageurl[1])) ? $page = $pageurl[1] : $page = '';
	// (isset($pageurl[2])) ? $action = $pageurl[2] : $action = '';
	// (isset($pageurl[3])) ? $id = $pageurl[3] : $id = 0;
 //    (isset($pageurl[4])) ? $id2 = $pageurl[4] : $id2 = 0;

    //Setting for local server
	$base_url = "http://" . $_SERVER['HTTP_HOST']. "/" .$pageurl[1];
	(isset($pageurl[2])) ? $page = $pageurl[2] : $page = '';
	(isset($pageurl[3])) ? $action = $pageurl[3] : $action = '';
	(isset($pageurl[4])) ? $id = $pageurl[4] : $id = 0;
    (isset($pageurl[5])) ? $id2 = $pageurl[5] : $id2 = 0;



class Core {

    function encode($string) {
        return $this->encrypt_decrypt('encrypt', $string);
    }

    function decode($string) {
        return $this->encrypt_decrypt('decrypt', $string);
    }

    function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'eXnumberFramework';
        $secret_iv = 'Omeoo Media';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    /*==-- Success message --==*/
    function successMessage($message, $redirect = NULL) {

        $msg = 

        '<div class="alert alert-success background-success animated zoomIn" role="alert">
                    '.$message.'
        </div>';
        if ($redirect != NULL) {
            $msg .= '<script>
                        $("html, body").animate({ scrollTop: 0 }, 600); 
                        setTimeout(function(){ $("#infoMessage").find("div.alert").remove() }, 3000);
                        setTimeout("window.location=\'' . $redirect . '\'",1000);
                    </script>';
        } else {
            $msg .= '<script>
                        $("html, body").animate({ scrollTop: 0 }, 600);
                        setTimeout(function(){ $("#infoMessage").find("div.alert").remove() }, 2500);
                    </script>';
        }
        return $msg;
    }

    /*==-- Error message --==*/
    function errorMessage($message) {
        $msg = 
        '<div class="alert alert-danger background-danger animated zoomIn" role="alert">
                   '.$message.'
                  </div>';
        $msg .= '<script>
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    setTimeout(function(){ $("#infoMessage").find("div.alert").remove() }, 2500);
                </script>';
        return $msg;
    }

    function date_indo($fulldate) {
        $date = substr($fulldate, 8, 2);
        $month = $this->get_month(substr($fulldate, 5, 2));
        $year = substr($fulldate, 0, 4);
        return $date . ' ' . $month . ' ' . $year;
    }

    function date_simple($fulldate) {
        $date = substr($fulldate, 8, 2);
        $month = substr($fulldate, 5, 2);
        $year = substr($fulldate, 0, 4);
        return $date . '/' . $month . '/' . $year;
    }

    function normal_date($fulldate) {
        $date = substr($fulldate, 8, 2);
        $month = $this->get_month3(substr($fulldate, 5, 2));
        $year = substr($fulldate, 0, 4);
        return $date . '/' . $month . '/' . $year;
    }

    function date_time($fulldate) {
        $date = substr($fulldate, 0, 2);
        $month = $this->get_month2(substr($fulldate, 3, 3));
        $year = substr($fulldate, 7, 4);
        $time = substr($fulldate, 12, 5);
        return $year . '-' . $month . '-' . $date . ' ' . $time;
    }

    function date_full($fulldate) {
        $date = substr($fulldate, 8, 2);
        $month = substr($fulldate, 5, 2);
        $year = substr($fulldate, 0, 4);
        $time = substr($fulldate, 11, 8);
        return $date . '/' . $month . '/' . $year . ' ' . $time;
    }

    function mysql_date($fulldate) {
        $date = substr($fulldate, 0, 2);
        $month = $this->get_month2(substr($fulldate, 3, 3));
        $year = substr($fulldate, 7, 4);
        return $year . '-' . $month . '-' . $date;
    }

    function get_month($month) {
        switch ($month) {
            case 1: return "Januari";
            case 2: return "Februari";
            case 3: return "Maret";
            case 4: return "April";
            case 5: return "Mei";
            case 6: return "Juni";
            case 7: return "Juli";
            case 8: return "Agustus";
            case 9: return "September";
            case 10: return "Oktober";
            case 11: return "November";
            case 12: return "Desember";
        }
    }

    function get_month2($month) {
        switch ($month) {
            case "Jan": return "01";
            case "Feb": return "02";
            case "Mar": return "03";
            case "Apr": return "04";
            case "May": return "05";
            case "Jun": return "06";
            case "Jul": return "07";
            case "Aug": return "08";
            case "Sep": return "09";
            case "Oct": return "10";
            case "Nov": return "11";
            case "Dec": return "12";
        }
    }

    function get_month3($month) {
        switch ($month) {
            case "01": return "Jan";
            case "02": return "Feb";
            case "03": return "Mar";
            case "04": return "Apr";
            case "05": return "May";
            case "06": return "Jun";
            case "07": return "Jul";
            case "08": return "Aug";
            case "09": return "Sep";
            case "10": return "Oct";
            case "11": return "Nov";
            case "12": return "Dec";
        }
    }

    function get_month4($month) {
        switch ($month) {
            case "01": return "I";
            case "02": return "II";
            case "03": return "III";
            case "04": return "IV";
            case "05": return "V";
            case "06": return "VI";
            case "07": return "VII";
            case "08": return "VIII";
            case "09": return "IX";
            case "10": return "X";
            case "11": return "XI";
            case "12": return "XII";
        }
    }

    function get_month5($month) {
        switch ($month) {
            case "01": return "Januari";
            case "02": return "Februari";
            case "03": return "Maret";
            case "04": return "April";
            case "05": return "Mei";
            case "06": return "Juni";
            case "07": return "Juli";
            case "08": return "Agustus";
            case "09": return "September";
            case "10": return "Oktober";
            case "11": return "November";
            case "12": return "Desember";
        }
    }

    function dropdown_month($month = '') {
        $month = ($month == '') ? date('m') : $month;
        $options = '';
        for($a=1; $a<=12; $a++) {
            $key = ($a<10) ? '0'.$a : $a;
            $selected = ($key==$month) ? 'selected' : '';
            $options .= '<option value="'.$key.'" '.$selected.'>'.get_month5($key).'</option>';
        }
        return $options;
    }


    function dropdown_year($year = '') {
        $options = '';
        for($a=0; $a<5; $a++) {
            $year = ($year == '') ? date('Y') : $year;
            $years = intval(date('Y')) - $a;
            $selected = ($years == $year) ? 'selected' : '';
            $options .= '<option value="'.$years.'" '.$selected.'>'.$years.'</option>';
        }
        return $options;
    }

    function ajaxRedirect($redirect = '', $timer = 0) {
        if ($timer == 0) {
            return '<script>window.location.href="' . $redirect . '";</script>';
        } else {
            return '<script>setTimeout("window.location.href=\'' . $redirect . '\'",' . $timer . ');</script>';
        }
    }
}

?>