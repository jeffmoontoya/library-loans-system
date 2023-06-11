
import './bootstrap';
import { createApp } from 'vue';
//Components
import ExampleComponent from './components/ExampleComponent.vue';

const app = createApp({
	components:{
		ExampleComponent
	}
});

//app.component('example-component', ExampleComponent);

app.mount('#app');
