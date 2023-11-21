<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    public $table = 'sectors';

    public $fillable = [
        'name',
        'district_id',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'district_id' => 'required',
    ];

    public function district(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\District::class, 'district_id');
    }

    public function cells(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Cell::class, 'sector_id');
    }
}
