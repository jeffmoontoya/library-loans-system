<?php

namespace App\Models;

use App\Models\Lend; // Importa el modelo Lend
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes; // Incluye los traits HasApiTokens, HasFactory y Notifiable

	protected $table = 'users'; // Especifica el nombre de la tabla en la base de datos

	protected $fillable = [
		'number_id',
		'name',
		'last_name',
		'email',
		'password',
	];
	// Define las columnas que se pueden asignar masivamente

	protected $appends = [
		'full_name'
	];
	// Define los atributos que se agregarán automáticamente a la respuesta JSON del modelo

	protected $hidden = [
		'password'
	];
	// Oculta los atributos especificados cuando se serializa el modelo a un arreglo o JSON

	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}
	// Define un atributo de acceso (accesor) que se agrega automáticamente a la respuesta JSON del modelo
	// El atributo 'full_name' se compone concatenando el 'name' y el 'last_name' del usuario

	protected $casts = [
		'created_at' => 'datetime:Y-m-d',
		'updated_at' => 'datetime:Y-m-d'
	];
	// Especifica los atributos que deben ser tratados como fechas (formato de casting)

	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}
	// Define un mutador (mutator) que se ejecuta automáticamente antes de asignar el valor al atributo 'password'
	// El valor del 'password' se hashea (se encripta) utilizando bcrypt antes de asignarlo al atributo

	public function CustomerLends()
	{
		return $this->hasMany(Lend::class, 'customer_user_id', 'id');
	}
	// Define una relación de uno a muchos (un usuario puede tener varios préstamos como cliente) con el modelo Lend
	// La clave externa en la tabla de préstamos es 'customer_user_id' y la clave primaria en la tabla de usuarios es 'id'

	public function OwnerLends()
	{
		return $this->hasMany(Lend::class, 'owner_user_id', 'id');
	}
	// Define una relación de uno a muchos (un usuario puede tener varios préstamos como propietario) con el modelo Lend
	// La clave externa en la tabla de préstamos es 'owner_user_id' y la clave primaria en la tabla de usuarios es 'id'
}
