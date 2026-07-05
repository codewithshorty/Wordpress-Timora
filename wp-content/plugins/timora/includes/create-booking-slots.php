<?php

function create_booking_slots()
{
    $slots = [];

    $firstSlot = strtotime("09:00");

    $lastSlot = strtotime("17:00");

    while ($firstSlot <= $lastSlot) {
        $slots[] = date("H:i", $firstSlot);
        $firstSlot = strtotime("+30 minutes", $firstSlot);
    }

    return $slots;
};
