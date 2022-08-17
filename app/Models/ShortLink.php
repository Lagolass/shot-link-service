<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * Class ShortLink
 * @package App\Models
 *
 * @property integer id
 * @property string link
 * @property string token
 * @property integer limit
 * @property integer count_entrance
 * @property string|Carbon expires
 */

class ShortLink extends Model
{
    use HasFactory;

    protected $table = 'short_links';

    public $timestamps = false;

    protected $fillable = [
       'link',
       'token',
       'limit',
       'expires',
    ];

    protected $dates = [
        'expires',
    ];

    protected $appends = [
        'short_link'
    ];

    public function getShortLinkAttribute()
    {
        return asset($this->token);
    }

    public function checkingOfExpiry()
    {
        if($this->expires->timestamp < Carbon::now()->timestamp)
            return false;

        if($this->limit != 0) {
            if ($this->count_entrance >= $this->limit)
                return false;
        }

        return true;
    }
}
