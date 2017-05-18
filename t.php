<?php
    $start_date     = '09/01/2015';
    $end_date       = '01/18/2016';
    $cdww   ='5';
    list($sm,$sd,$sy) = split("/",$start_date);
    $start	= "$sy-$sm-$sd";
    $smo    = $sm+$cdww;
    if($smo>'12')
    {
        $ssy=$sy+'1';
        $ssm=$smo-'12';
        $starto	= "$ssy-$ssm-$sd";
    }else
    {
        $starto	= "$sy-$smo-$sd";
    }
    list($em,$ed,$ey) = split("/",$end_date);
    $end	= "$ey-$em-$ed";
    
	$startt    = date("oW", strtotime("$starto"));
	$endd      = date("oW", strtotime("$end"));
    
    if($startt>$endd)
    {
        echo "<script>alert('กรุณาตรวจสอบวันที่การอบรม');</script>";
		exit();
    }
?>