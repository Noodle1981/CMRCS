<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'company_name',
        'company_name_for_emails',
        'email',
        'email_status',
        'departments',
        'contact_owner',
        'corporate_phone',
        'employee_count',
        'industry',
        'keywords',
        'person_linkedin_url',
        'website',
        'company_linkedin_url',
        'facebook_url',
        'city',
        'state',
        'country',
        'company_address',
        'company_city',
        'company_state',
        'company_country',
        'company_phone',
        'technologies',
        'annual_revenue'
    ];


    public function services() {
        return $this->belongsToMany(Service::class, 'provider_service');
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function interactions() {
        return $this->morphMany(Interaction::class, 'interactable');
    }
}
