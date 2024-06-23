<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_pembayaran', 'id_user', 'id_product', 'amount'
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_pembayaran');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
