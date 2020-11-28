<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Task extends Model
{
    /**
     * 状態定義
     */
    const STATUS = [
        1 => ['label' => '未着手'],
        2 => ['label' => '着手中'],
        3 => ['label' => '完了'],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        // 状態値
        // $status = $this->attributes['status'];
        $status = $this->status;
        // error_log($status);
        Log::debug($status);
        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }

    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        // return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
        //     ->format('Y/m/d');
        return Carbon::createFromFormat('Y-m-d', $this->due_date)
            ->format('Y/m/d');
    }
}
