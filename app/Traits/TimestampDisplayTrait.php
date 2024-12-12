<?php

namespace App\Traits;

use Carbon\Carbon;

trait TimestampDisplayTrait
{
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function human_date()
    {
        $date = Carbon::parse($this->created_at)->locale('ru_RU');
        $formattedDate = $date->translatedFormat('j F Y год');
        return $formattedDate;
    }

    public function human_datetime()
    {
        $date = Carbon::parse($this->created_at)->locale('ru_RU');
        $formattedDate = $date->translatedFormat('j F Y H:i');
        return $formattedDate;
    }

    public function human_time()
    {
        $date = Carbon::parse($this->created_at)->locale('ru_RU');
        $formattedDate = $date->translatedFormat('H:i');
        return $formattedDate;
    }

    public function human_diff()
    {
        $date = Carbon::parse($this->created_at)->locale('ru_RU');
        $formattedDate = $date->diffForHumans();
        return $formattedDate;
    }
}