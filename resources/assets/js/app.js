
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Vue.use(require('vue-moment'));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', 	require('./components/ExampleComponent.vue'));
//Vue.component('counter-component',  	require('./components/CounterComponent.vue'));
Vue.component('meme-stream', 			require('./components/MemeStream.vue'));
//Vue.component('file-upload',			require('./components/FileUpload.vue'));
Vue.component('meme-upload',			require('./components/MemeUpload.vue'));
Vue.component('blab-show',				require('./components/BlabShow.vue'));
Vue.component('blab-post',				require('./components/BlabPost.vue')); 
Vue.component('chat-blab-index',		require('./components/ChatBlabIndex.vue'));
Vue.component('blab-container',			require('./components/BlabContainer.vue'));
//Vue.component('tabs',					require('./components/tabs/components/Tabs.vue'));
//Vue.component('tab',					require('./components/tabs/components/Tab.vue'));
//Vue.component('modal',				require('./components/Modal.vue'));

Vue.component('subscribe-button',		require('./components/SubscribeButton.vue'));
Vue.component('sponsor-button',			require('./components/SponsorButton.vue'));
Vue.component('meme-upload-to-chat',	require('./components/MemeUploadToChat.vue'));
Vue.component('blab-top-users',			require('./components/BlabTopUsers.vue'));
Vue.component('user-data-chart',		require('./components/UserDataChart.vue'));
Vue.component('word-data-chart',		require('./components/WordDataChart.vue'));
Vue.component('text-input',				require('./components/TextInput.vue'));

const app = new Vue({ 
    el: '#app'
});
