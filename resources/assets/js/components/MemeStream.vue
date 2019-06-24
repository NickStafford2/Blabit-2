<template>
	<div>
	    <b-carousel 
	    	id="carousel1"
			style="text-shadow: 1px 1px 2px #333;"
			controls
			indicators
			background="#000"
			:interval="4000"
			img-width="1024"
			img-height="480"
			v-model="slide"
			@sliding-start="onSlideStart"
			@sliding-end="onSlideEnd"
	    >
			<!--b-carousel-slide 
				v-for="meme in memes"
				:key="meme.id"
			    :img-src="'/storage/memes/' + meme.img"
			    img-width="1024" 
			    img-height="480"
				caption="First slide"
			    text="Nulla vitae elit libero, a pharetra augue mollis interdum."
			>
			</b-carousel-slide-->
			<b-carousel-slide
				v-for="meme in memes"
				:key="meme.id"
				:caption="meme.title"
			    :text="meme.description"
			>
        		<img 
        			slot="img" 
        			class="d-block img-fluid w-100 meme-carousal-height" 
             		:src="'/storage/memes/' + meme.img"
             		alt="image slot"
             	>

      		</b-carousel-slide>
	    </b-carousel>
		<!--a href="/memes/create" class="btn btn-primary">Create Meme</a-->
		<br>
        <button class="btn btn-primary" id="show-create-meme-modal" @click="showCreateModal">New Meme</button>
        <button class="btn btn-primary" id="show-link-existing-modal" @click="showMyMemes">Link Existing Meme</button>
		<!-- use the modal component, pass in the prop -->
		
		<modal name="new-meme" height="auto" :scrollable="true">
  			<meme-upload-to-chat :chat_id="chat_id"></meme-upload-to-chat>
		</modal>

		<modal name="my-memes" height="auto" :scrollable="true">
  			<div class="m-3">
  				<h3>Select a meme to post</h3>
				<ul class="list-group">
					<li :class="{ selected : memeToUpload==meme }" class="list-group-item d-flex justify-content-between" v-for="meme in myMemes" @click="existingMemeSelected(meme)">
						<img class="memeImage" :src="'/storage/memes/' + meme.img" alt="could not find" height="100" width="auto">
						<div class="text-right">
							<h4>{{meme.title}}</h4>
							<p>{{meme.description}}</p>
						</div>
					</li>
				</ul>
				<button :disabled="memeToUpload === null" class="btn btn-primary mt-2" @click="sumbitExistingMeme(memeToUpload.id)">Post</button>
  			</div>
		</modal>
	</div>
</template>



<script>
	//import { Carousel, Slide } from 'vue-carousel';
	import VModal from 'vue-js-modal';
	import BootstrapVue from 'bootstrap-vue'
	import 'bootstrap/dist/css/bootstrap.css'
	import 'bootstrap-vue/dist/bootstrap-vue.css'
	//import VueAgile from 'vue-agile';

	window.Vue.use(VModal, { dynamic: true, injectModalsContainer: true });
	window.Vue.use(BootstrapVue);
	//window.Vue.use(VueAgile);

	export default {
	/*	 components: {
    		Carousel,
    		Slide
  		},*/
		props: {
			chat_id: 	{ required: true }
		},
		data() {
			return {
				message: 'Hello World',
				memes: [],
				myMemes: [],
				memeToUpload: null,
				currentMeme: null,
    	  		slide: 0,
	      		sliding: null
			};
		},
		methods: {
		  	showMyMemes () {
		  		window.axios.post('/memes/getMyMemes')
					.then(response => {
						//console.log(response);
						this.myMemes = response.data;
					});
		    	this.$modal.show('my-memes');
		  	},
		  	hideMyMemes () {
		    	this.$modal.hide('my-memes');
		  	},
		  	showCreateModal() {
		  		this.$modal.show('new-meme');

		  	},
		  	submitNewMeme() {

		  	},

		  	sumbitExistingMeme(meme_id) {
		  		window.axios.post('/memes/attachChat/${request}', {chat_id: this.chat_id, meme_id: meme_id})
		  		.then(response => {
		  			console.log(response);
		  		});
		  		this.$modal.hide('my-memes');

		  	},
		  	existingMemeSelected(meme) {
		  		this.memeToUpload = meme;
		  	},
		    onSlideStart (slide) {
      			this.sliding = true
    		},
    		onSlideEnd (slide) {
      			this.sliding = false
    		}
		},
		computed: {

		},
		created: function() {
			window.axios.post('/memes/getChatMemes/${chat_id}', {chat_id: this.chat_id})
				.then(response => {
					console.log(response);
					this.memes = response.data;
					this.currentMeme = this.memes[0];
				}
			);
			/*
	  		window.axios.post('/memes/getMyMemes')
				.then(response => {
					console.log(response);
					this.memes = response.data;
					this.currentMeme = this.memes[0];
				}
			);*/
		}
	};
</script>




<style scoped>
.selected{
	background-color: #aaa;
}
.memeImage {
	object-fit: contain;
	max-width: 250px;
}

.memeStream {
	object-fit: contain;
	max-width: 100%;	
	background-color: black;
}
.meme-carousal-height {
	/*object-fit: cover;*/
	object-fit: contain;
	height: 350px !important;
}
	
</style>