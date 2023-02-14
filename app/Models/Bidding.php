<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidding extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'organizer',
        'debtor',
        'subject',
        'status',
        'started_at',
        'external_id',
        'details'
    ];

    public function startedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->translatedFormat('d.m.Y, H:i'),
        );
    }
}
