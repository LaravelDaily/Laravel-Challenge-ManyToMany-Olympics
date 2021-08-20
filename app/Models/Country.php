<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $appends = ['result_count'];

    public function results(){

        return $this->belongsToMany(Sport::class,'results','country_id','sport_id')->withPivot('result');

    }

    public function getResultCountAttribute(){

        $gold   = 0;
        $silver = 0;
        $bronze = 0;

        foreach ($this->results as $result) {
            switch ($result->pivot->result) {
            case 1:
                $gold++;
                break;
            case 2:
                $silver++;
                break;
            case 3:
                $bronze++;
                break;
            }
        }

        return ['gold' => $gold, 'silver' => $silver, 'bronze' => $bronze];

    }

    protected $fillable = ['name', 'short_code'];
}
