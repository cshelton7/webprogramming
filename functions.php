<?php

    function showToday() {
        date_default_timezone_set('US/Eastern');
        echo date("m-d-Y h:i");
    }
?>