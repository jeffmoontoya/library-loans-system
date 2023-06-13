<template>
	<table class="table" id="bookTable" @click="getEvent">
		<thead>
			<tr>
				<th>Titulo</th>
				<th>Autor</th>
				<th>Stock</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</template>

<script>
	export default {
		data() {
			return {
				books: [],
				datatable: {}
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				this.mountDataTable()
			},
			mountDataTable() {
				this.datatable = $('#bookTable').DataTable({
					processing: true,
					serverSide: true,
					ajax: {
						url: '/Books/GetAllBooksDataTable'
					},
					columns: [
						{ data: 'title' },
						{ data: 'author.name', searchable: false },
						{ data: 'stock' },
						{ data: 'action' }
					]
				})
			},
			async getBooks() {
				try {
					this.load = false
					const { data } = await axios.get('Books/GetAllBooks')
					this.books = data.books
					this.load = true
				} catch (error) {
					console.error(error)
				}
				this.mountDataTable()
			},
			getEvent(event) {
				const button = event.target
				if (button.getAttribute('role') == 'edit') {
					this.getBook(button.getAttribute('data-id'))
				}

				if (button.getAttribute('role') == 'delete') {
					this.deletBook(button.getAttribute('data-id'))
				}
			},
			async getBook(book_id) {
				try {
					const { data } = await axios.get(`Books/GetABook/${book_id}`)
					this.$parent.editBook(data.book)
				} catch (error) {
					console.error(error)
				}
			},
			async deletBook(book_id) {
				try {
					const result = await swal.fire({
						icon: 'info',
						title: 'Quieres eliminar el libro?',
						showCancelButton: true,
						confirmButtonText: 'Eliminar'
					})

					if (!result.isConfirmed) return

					this.datatable.destroy()
					await axios.delete(`Books/DeleteABook/${book_id}`)
					this.index()
					swal.fire({
						icon: 'success',
						title: 'Felicidades!',
						text: 'Libro Eliminado!'
					})
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>


