<?php
class WorkStatus
{
    const PLANNING = 1;
    const DOING = 2;
    const COMPLETED = 3;

    public static function all()
    {
        return  [
            self::PLANNING => 'Lập kế hoạch',
            self::DOING => 'Đang làm',
            self::COMPLETED => 'Hoàn thành',
        ];
    }
    
    public static function getValueStatus($value)
    {
        $data = self::all();

        return $data[$value] ?? null;
    }
}
