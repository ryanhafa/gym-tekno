<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Member extends Model implements AuthenticatableContract
{
    use AuthenticatableTrait, HasFactory, Notifiable;

    protected $fillable = [
        'barcode',
        'name',
        'email',
        'phone',
        'address',
        'membership_type',
        'status',
        'quota',
        'join_date',
        'expiry_date',
        'notes',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'join_date' => 'date',
            'expiry_date' => 'date',
            'quota' => 'integer',
            'password' => 'hashed',
        ];
    }

    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(AttendanceLog::class);
    }

    public static function generateBarcode(): string
    {
        $prefix = 'GTK';
        do {
            $barcode = $prefix.strtoupper(substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 12));
        } while (static::where('barcode', $barcode)->exists());

        return $barcode;
    }
}
