<?php
date_default_timezone_set("Asia/Bangkok");
    $now = new DateTime();
    // $now->add(new DateInterval("PT5H"));
    $newTime = $now->format("Y-m-d H:i:s");
    $expiredDb = date("Y-m-d H:i:s", strtotime('+6 hours'));
    echo $newTime;
?>