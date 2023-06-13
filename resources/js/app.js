import './bootstrap'
import { createApp } from 'vue'
import vSelect from 'vue-select'
//Components
import BooksList from './components/Books/index.vue'

const app = createApp({
	components: {
		BooksList
	}
})

app.component('v-select', vSelect)
app.mount('#app')
