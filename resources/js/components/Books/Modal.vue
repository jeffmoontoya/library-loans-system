<template>
	<div class="modal fade" id="book_modal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">
						{{ `${is_create ? 'Crear' : 'Actualizar'} Libro` }}
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<form @submit.prevent="storeBook">
						<div class="mb-3">
							<label for="title" class="form-label">Titulo</label>
							<input type="text" class="form-control" id="title" v-model="book.title">
						</div>
						<div class="mb-3">
							<label for="stock" class="form-label">Stock</label>
							<input type="number" class="form-control" id="stock" v-model="book.stock">
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Descripción</label>
							<textarea class="form-control" id="description" rows="3" v-model="book.description"></textarea>
						</div>
						<div class="mb-3">
							<label for="category" class="form-label">Categorias</label>
							<v-select id="category" :options="categories" v-model="book.category_id"
								:reduce="category => category.id" label="name" :clearable="false">
							</v-select>
						</div>
						<div class="mb-3">
							<label for="author" class="form-label">Author</label>
							<v-select id="author" :options="authors" v-model="book.author_id" :reduce="author => author.id"
								label="name" :clearable="false">
							</v-select>
						</div>

						<hr>
						<section class="d-flex justify-content-end mt-3">
							<button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary me-1">
								{{ `${is_create ? 'Crear' : 'Actualizar'}` }}
							</button>
						</section>
					</form>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import axios from 'axios'
export default {
	data() {
		return {
			is_create: true,
			categories: [],
			authors: [],
			book: {}
		}
	},
	created() {
		this.index()
	},
	methods: {
		index() {
			this.getCategories()
			this.getAuthors()
		},
		async getCategories() {
			const { data } = await axios.get('/api/Categories/GetAllCategories')
			this.categories = data.categories
		},
		async getAuthors() {
			const { data } = await axios.get('/api/Authors/GetAllAuthors')
			this.authors = data.authors
		},
		async storeBook() {
			try {
				if (this.is_create) {
					await axios.post('api/Books/SaveBook', this.book)
				} else {
					await axios.put(`api/Books/UpdateBook/${this.book.id}`, this.book)
				}
				swal.fire({
					icon: 'success',
					title: 'Felicidades!',
					text: 'Libro almacenado!'
				})
				this.$parent.closeModal()
			} catch (error) {
				console.error(error)
				swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Algo salio mal!'
				})
			}
		}
	}
}
</script>

<style></style>
