<template>
	<div class="card mx-5 my-5">

		<div class="card-header d-flex justify-content-between">
			<h2>Libros</h2>
			<button @click="openModal" class="btn btn-primary">Crear Libro</button>
		</div>

		<div class="card-body">
			<section class="table-responsive" v-if="load">
				<table-component :books_data="books" />
			</section>

			<!-- Load -->
			<section v-else class="d-flex justify-content-center my-3">
				<div class="spinner-border" role="status">
					<span class="visually-hidden">Loading...</span>
				</div>
			</section>
		</div>

		<section v-if="load_modal">
			<modal />
		</section>
	</div>
</template>



<script>
	import TableComponent from './Table.vue'
	import Modal from './Modal.vue'

	export default {
		components: {
			TableComponent,
			Modal
		},
		data() {
			return {
				books: [],
				load: false,
				load_modal: false,
				modal: null
			}
		},
		created() {
			this.index()
		},
		methods: {
			async index() {
				await this.getBooks()
			},
			async getBooks() {
				try {
					this.load = false
					const { data } = await axios.get('/api/Books/GetAllBooks')
					this.books = data.books
					this.load = true
				} catch (error) {
					console.error(error)
				}
			},
			openModal() {
				this.load_modal = true
				setTimeout(() => {
					this.modal = new bootstrap.Modal(document.getElementById('book_modal'), {
						keyboard: false
					})
					this.modal.show()

					const modal = document.getElementById('book_modal')
					modal.addEventListener('hidden.bs.modal', () => {
						this.load_modal = false
					})
				}, 200)
			},
			closeModal() {
				this.modal.hide()
				this.getBooks()
			}
		}
	}
</script>
