<?php

namespace SteadfastCollective\CashierExtended;

use Illuminate\Database\Eloquent\Model;

class ChargeCoupon extends Model
{

     /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount_off' => 'integer',
        'percent_off' => 'decimal',
        'max_redemptions' => 'integer',
    ];

    /**
     * Calculate the Coupon discount.
     *
     * @param  int $amount
     * @return \Stripe\Coupon
     */
    public function calculateFinalAmount(int $amount) : int
    {
        if ($this->amount_off !== null) {
            $amount = $amount - $this->amount_off;
        } elseif ($this->percent_off !== null) {
            $amount = $amount * ($this->percent_off / 100);
        }

        $amount = (int) (round($amount));

        return $amount;
    }

}
