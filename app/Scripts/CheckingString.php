<?php

namespace App\Scripts;

function checkLang($str)
{
    $arrayString = mb_str_split($str);
    $engSymbolsLen = count(preg_grep('/[A-Za-z]/', $arrayString));
    $rusSymbolsLen = count(preg_grep('/[А-Яа-я]/', $arrayString));
    $mainLang = $rusSymbolsLen >= $engSymbolsLen ? 'rus' : 'eng';
    return $mainLang;
}

function replacedString($str)
{
    $arrayString = mb_str_split($str);
    if (checkLang($str) === 'rus') {
        $newStr = implode(array_map(fn($value) => preg_replace('/[A-Za-z]/', '<b>'.$value.'</b>', $value), $arrayString));
        print_r($newStr);
        return $newStr;
    } else {
        $newStr = implode(array_map(fn($value) => mb_ereg_replace('[А-Яа-я]', '<b>'.$value.'</b>', $value), $arrayString));
        print_r($newStr);
        return $newStr;
    }
}
