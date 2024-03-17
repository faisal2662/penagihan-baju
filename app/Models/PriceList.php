<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceList extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

      public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'size'
            ]
        ];
    }



    /**
     * Get all of the comments for the PriceList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customer(): HasMany
    {
        return $this->hasMany(Customer::class, 'id_price_list', 'id');
    }    
 

}