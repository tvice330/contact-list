<?php

namespace ContactList\Model;

class Phone extends Model
{

    protected $table = 'phones';
    protected $fillable = ['contact_id','number'];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}