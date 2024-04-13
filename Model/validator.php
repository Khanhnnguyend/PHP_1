<?php 
class Validate {
    public function enCode($code) {

        $code = htmlspecialchars($code);

        return $code;
    }

}

?>