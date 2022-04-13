<?php

class Student
{
    private const AVG = 5;

    public function __construct(public string $name)
    {
    }

    // 5教科の平均点を計算
    public function cal_avg(...$point): float
    {
        $avg = 0;
        foreach ($point as $point) {
            $avg += $point / self::AVG;
        }
        return $avg;
    }

    // 平均点以上なら合格
    public function judge($avgPoint)
    {
        if ($avgPoint >= 70) {
            echo '合格' . PHP_EOL;
        } else {
            echo '不合格' . PHP_EOL;
        }
    }
}

$student = new Student('田中');
$avgPoint = $student->cal_avg(70, 80, 60, 90, 80);
$result = $student->judge($avgPoint);