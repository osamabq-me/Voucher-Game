<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_history';

    protected $fillable = [
        'id_pembayaran', 'id_user', 'id_product', 'amount', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_pembayaran', 'id_pembayaran');
    }
}
