<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['name', 'short_code'];
    protected $searchCoulumn = ['name'];

    public function getId(String $shorCode)
    {
        return $this->select('id')->where('short_code', $shorCode)->first()->id ?? 0;
    }

    /**
     * Get all of the medals for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getGold()
    {
        return $this->hasMany(CountryMedal::class, 'gold', 'id');
    }
    /**
     * Get all of the silver medals for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getSilver()
    {
        return $this->hasMany(CountryMedal::class, 'silver', 'id');
    }
    /**
     * Get all of the bronze medals for the Country
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getBronze()
    {
        return $this->hasMany(CountryMedal::class, 'bronze', 'id');
    }
}
