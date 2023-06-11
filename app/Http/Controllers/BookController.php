<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\CreateBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Obtener un libro específico por su ID.
     */
    public function getABook(Book $book)
    {
        return response()->json(['book' => $book], 200);
    }

    /**
     * Obtener todos los libros.
     */
    public function getAllBooks()
    {

		$books = Book::get();
		return response()->json(['books' => $books], 200);
    }

    /**
     * Crear un nuevo libro.
     */
    public function createBook(CreateBookRequest $request)
    {
		$Book = new Book($request->all());
		$Book->save();
		return response()->json(['book' => $Book], 201);
    }

    /**
     * Actualizar un libro existente.
     */
	public function updateBook(Book $book, UpdateBookRequest $request)
	{
		$book->update($request->all());
		return response()->json(['book' => $book->refresh()], 201);
	}
    /**
     * Eliminar un libro.
     */
    public function deleteBook(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Libro eliminado correctamente']);
    }
}
