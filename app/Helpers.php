<?php

function formatRupiah($nominal, $prefix = false)
{
    if ($prefix) {
        return $prefix . "Rp. " . number_format($nominal, 0, ',', '.');
    }
    return number_format($nominal, 0, ',', '.');
}

function formatDesimal($nominal, $prefix = false)
{
    if ($prefix) {
        return $prefix . "Rp. " . number_format($nominal, 2, ',', '.');
    }
    return number_format($nominal, 2, ',', '.');
}
