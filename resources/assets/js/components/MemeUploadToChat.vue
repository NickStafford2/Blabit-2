<template>
	<div class="m-2">
		<h1>Create New Meme</h1>
		<div class="custom-file">
			<input type="file" class="custom-file-input" id="img" :name="img" ref="img" @change="handleFileUpload">
			<label class="custom-file-label" for="img">{{imgName}}</label>
		</div>
		<div class="form-group">
			<label for="title">Title</label>
			<input class="form-control" type="text" name="title" v-model="title">
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input class="form-control" type="text" name="description" v-model="description">
		</div>
		<button class="btn btn-primary" :disabled="img===null" @click="submit">Submit</button>
		<!--button :disabled="memeToUpload === null" class="btn btn-primary mt-2" @click="submitNewMeme">Post</button-->
	</div>
</template>



<script>

	export default {
		props: {
			chat_id: 	{ required: true }
		},

		data() {
			return {
				img: null,
				imgName: 'Image',
				title: null,
				description: null
			};
		},
		methods: {
			submit() {
				let formData = new FormData();
				formData.append('img', 			this.img);
				formData.append('title', 		this.title);
				formData.append('description',	this.description);
				formData.append('chat_id', 		this.chat_id);

				axios.post('/memes', formData, {
	                headers: {
	                    'Content-Type': 'multipart/form-data'
	                }
				}).then(response => {
						console.log(response);
						//this.push(response.data);
					})
        		.catch(response => {
						console.log(response);
						//this.push(response.data);
					})
			},
			handleFileUpload() {
				console.log(this.$refs.img.files[0]);

				this.img = this.$refs.img.files[0];
				this.imgName = this.img.name;
			}

		},
		computed: {

		}
	};
</script>




<style scoped>
	
</style>