<x-app title="Biblioteca Central">

	{{-- A Book --}}
	<section class="d-flex justify-content-center flex-wrap">
		@foreach ($books as $book )
			<div class="card mx-3 my-3" style="width: 18rem;">
				@if ($book->image)
					<img src="/storage/images/{{$book->image}}" class="card-img-top" alt="Libro">
				@else
					<img src="https://cdn.lorem.space/images/book/.cache/150x150/the-great-gatsby.jpeg" class="card-img-top" alt="Libro">
				@endif

				<div class="card-body">
					<h5 class="card-title">{{$book->title}}</h5>
					<p class="card-text">{{$book->description}}</p>
					<a href="#" class="btn btn-primary">Prestar</a>
				</div>
			</div>
		@endforeach
	</section>

</x-app>

