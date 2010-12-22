<?php


//
// Make sure object is an array;
// otherwise wrap inside array
//

function arrayify(&$maybeArray) {

    if (is_array($maybeArray)) {
        return $maybeArray;
    } else {
        return array($maybeArray);
    }
}


?>
