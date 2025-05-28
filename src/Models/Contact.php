<?php

namespace Tvice\ContactList\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'contacts';

    /**
     * @var string[]
     */
    protected $fillable = ['first_name', 'last_name'];

    /**
     * @return HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}