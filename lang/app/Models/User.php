<?php

namespace App\Models;

use App\Models\Lend;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];

	protected $hidden = [
		'password'
	];

	protected $appends = ['full_name'];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d',
	];

	// Accessor (get)
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}"; // David Torres
	}

	// Mutator (create - update)
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value); //isjisjdisj093u49ksndisac
	}

	// Relations -----------------------------------------------------------------

	// Prestamos que adquirio el cliente
	public function CustomerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}

	// Prestamos que hizo el bibliotecario
	public function OwnerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
}
