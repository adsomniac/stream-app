<?php

namespace App\Models;

use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'packaged_id',
        'user_id',
        'amount',
        'transaction_code',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'packages_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
