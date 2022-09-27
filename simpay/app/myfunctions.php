<?php

function trans_status($id){
    $status = [
        1 => 'Initiated',
        2 => 'Pending',
        3 => 'Completed',
        4 => 'Declined'
    ];
    return $status[$id];
}