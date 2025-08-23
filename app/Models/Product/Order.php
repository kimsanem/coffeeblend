<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        "first_name",
        "last_name",
        "state",
        "zip_code",
        "phone",
        "address",
        "city",
        "price",
        "email",
        "user_id",
        "status"
    ];
//    public $timestamps = true;
}
