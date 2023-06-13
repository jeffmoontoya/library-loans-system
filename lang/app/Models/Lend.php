<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lend extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'lend';

	protected $fillable = [
		'owner_user_id', //prestamista (bibliotecario)
		'customer_user_id', //prestador (cliente)
		'book_id',
		'date_out',
		'date_in',
		'status',
	];

	// Cliente quien prestro el libro
	public function Customer()
	{
		return $this->belongsTo(User::class, 'customer_user_id', 'id');
	}

	// Bibliotecario quien hizo el prestamo
	public function Owner()
	{
		return $this->belongsTo(User::class, 'owner_user_id', 'id');
	}

	// Libro que presto
	public function Book()
	{
		return $this->belongsTo(Book::class, 'book_id', 'id');
	}
}
