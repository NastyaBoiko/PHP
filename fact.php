<?php

// ПР4
// Задача 1. Используя рекурсию, реализовать функцию вычисления факториала числа.

function fact($a)
{
   if (is_int($a)) {
      if ($a < 0) {
         $res = "Факториала нет";
      } elseif ($a === 0) {
         $res = 1;
      } else {
         $res = $a * fact ($a - 1);
      }
   } else {
         $res = "Ошибка, введите число";
   }

   // if($a > 1) {
   //    $r = $a * fact($a - 1);
   // } elseif ($a > -1){
   //    $r = 1;
   // } else {
   //    $r = "факториал не существует";
   // }

   return $res;
}

echo fact (3) . "<br>";

/* 
Задача 2. Дан массив вида, который может иметь неограниченную вложенность.
Требуется реализовать рекурсивную функцию, которая, на основе данного массива формировала список. Для формирования списка используются теги «<ul></ul><li></li>». */

$someArray = [
    'id' => 1,
    'name' => 'item1',
    'items' => [
      [
        'id' => 2,
        'name' => 'item2',
        'items' => [],
      ],
      [
        'id' => 3,
        'name' => 'item3',
        'items' => [[],[],[],null, []],
      ],
      [
        'id' => 4,
        'name' => 'item4',
        'items' => [
            [
              'id' => 5,
              'name' => 'item5',
              'items' => [],
            ],
            [
              'id' => 6,
              'name' => 'item6',
              'items' => [],
            ],
         ],
      ],
   ]
];

function mas($array)
{
   echo "<ul>";
      foreach ($array as $key => $val) {
         if (!is_array($val)) {
            if (is_null($val)) {
               echo "<li>$key => null</li>";
            } else {
               echo "<li>$key => $val</li>";
            }
         } elseif (is_array($val) && !$val) {
            echo "<li>$key => [] </li>";
         } elseif (is_array($val) && $val) {
            if(!is_numeric($key)) {
               echo "<li> $key => </li>";
            } 
            mas($val);
            echo "<br>";
         }
      }
      echo "</ul>";
}

mas($someArray);
