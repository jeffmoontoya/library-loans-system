<x-app title="Central Library">

	<section class="d-flex justify-content-center flex-wrap">
		@foreach ($books as $book)
		<div class="card mx-3 my-3" style="width: 18rem;">
			<img src="https://3.bp.blogspot.com/-B-fvBh56lpI/UHC5X70tjrI/AAAAAAAAXT0/ObVodIHL73Y/s1600/libros1.jpg" class="card-img-top" alt="...">
			<div class="card-body">
				<h5 class="card-title">{{$book->title}}</h5>
				<p class="card-text">Author: {{$book->author->name}}</p>
				<p class="card-text">Category: {{$book->category->name}}</p>
				<p class="card-text">Description: {{$book->description}}</p>
				<a href="#" class="btn btn-primary">Read Now</a>
			</div>
		</div>
		@endforeach
	</section>
</x-app>
