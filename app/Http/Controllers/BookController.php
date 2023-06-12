<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
	// Mostrar todos los libros en vista libros
	public function showBooks()
	{
		return view('books.index');
	}

	// Obtener un libro
	public function getABook(Book $book)
	{
		return response()->json(['book' => $book], 200);
	}

	// Mostrar el home con los libros
	public function showHomeWithBooks()
	{
		$books = $this->getAllBooks()->original['books'];
		return view('index', compact('books'));
	}

	// Obtener todos los libros
	public function getAllBooks()
	{
		$books = Book::with('author', 'category')->get();
		return response()->json(['books' => $books], 200);
	}

	// Crear un libro
	public function createBook(CreateBookRequest $request)
	{
		$Book = new Book($request->all());
		$Book->save();
		return response()->json(['book' => $Book], 201);
	}

	// Actualizar un libro
	public function updateBook(Book $book, UpdateBookRequest $request)
	{
		$book->update($request->all());
		return response()->json(['book' => $book->refresh()], 201);
	}

	// Eliminar un libro
	public function deleteBook(Book $book)
	{
		$book->delete();
		return response()->json(['message' => 'Libro eliminado correctamente']);
	}
}
