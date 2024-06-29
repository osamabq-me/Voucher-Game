<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    use HasFactory;

    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_user', 'id_product', 'method', 'total', 'whatsapp'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function history()
    {
        return $this->hasOne(History::class, 'id_pembayaran');
    }
}
