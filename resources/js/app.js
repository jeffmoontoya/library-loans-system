
import './bootstrap';
import { createApp } from 'vue';
//Components
import BooksList from './components/Books/index.vue';

const app = createApp({
	components:{
		BooksList
	}
});

//app.component('example-component', ExampleComponent);

app.mount('#app');
