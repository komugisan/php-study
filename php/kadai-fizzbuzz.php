<?php

fizzbuzz();

function fizzbuzz() {
    // 内容は省略。自力で考えてみましょう。
    $max = 100;

    for($i=1;$i<=$max;$i++){
        //数値が3の倍数であり5の倍数でもある場合
        if($i%3 === 0 && $i%5 === 0){
            print_r("FizzBuzz") . PHP_EOL;
        }
        //数値が3の倍数
        else if($i%3 === 0){
            print_r("Fizz") . PHP_EOL;
        }
        //数値が5の倍数
        else if($i%5 === 0){
            print_r("Buzz") . PHP_EOL;
        }
        //その他はそのまま
        else{
            print_r($i) . PHP_EOL;
        }
    }


}