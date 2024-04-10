<?php 
class Validate {
    public function enCode($code) {

        $code = htmlspecialchars($code);

        return $code;
    }

    public function checkPositiveNumber($number) {
        
    }

    public function checkImage($image,$input) {
        
    }

}

?>