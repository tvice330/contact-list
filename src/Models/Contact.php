<?php

namespace Tvice\ContactList\Model;

class Contact extends Model
{
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