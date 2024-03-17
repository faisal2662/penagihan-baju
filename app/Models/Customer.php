<?php

namespace App\Models;

use App\Models\Color;
use App\Models\Payment;
use App\Models\session;
use App\Models\Category;
use App\Models\PriceList;
use App\Models\Transaction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

       public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * Get the pricelist associated with the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pricelist(): HasOne
    {
        return $this->hasOne(PriceList::class, 'slug', 'slug_price_list');
    }

    /**
     * Get all of the transaction for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'slug_customer', 'slug');
    }

    /**
     * Get all of the payment for the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function payment(): HasMany
    // {
    //     return $this->hasMany(Payment::class, 'id_customer', 'id');
    // }
    /**
     * Get the payment associated with the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'slug_customer', 'slug');
    }

    /**
     * Get the color associated with the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function color(): HasOne
    {
        return $this->hasOne(Color::class, 'slug', 'slug_color');
    }

    /**
     * Get the category associated with the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'slug', 'slug_category');
    }

    /**
     * Get the session associated with the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function session(): HasOne
    {
        return $this->hasOne(session::class, 'slug', 'slug_session');
    }
}