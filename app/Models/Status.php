<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{

    const WAITING = 1; // ОЖИДАНИЕ
    const IN_PROGRESS = 2; // В ХОДЕ ВЫПОЛНЕНИЯ
    const UPCOMING = 3; // ПРЕДСТОЯЩИЙ
    const NOT_PAID = 4; // НЕ ОПЛАЧЕНО
    const REJECTED = 5; // ОТКЛОНЕН
    const APPLICATION_SENT = 6; // ЗАЯВКА ОТПРАВЛЕНА
    const DONE = 7; // СДЕЛАННЫЙ
    const SAVED_TO_LATER = 8; // СОХРАНЕНО ПОЗЖЕ

    protected $fillable = ['title'];

    public static function getStatusList($value = 'title',$key = 'id')
    {
        return static::latest()
            ->whereIn('id',[Status::NOT_PAID,Status::WAITING])
            ->pluck($value,$key);
    }
}
