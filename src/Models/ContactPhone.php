<?php

namespace Tvice\ContactList\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhone extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'contact_phones';

    /**
     * @var string[]
     */
    protected $fillable = ['contact_id','number'];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}