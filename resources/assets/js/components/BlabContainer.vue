<template>
	<div class="row">
		<div class="col-md-7">
			<div class="blabit-light-bg">
				<b-tabs class="chat-extras" >
					<b-tab class="chat-extras-tab-head" title="Meme Stream" :title-link-class="linkClass(0)"active>
						<div class="bg-white blabit-border">
							<meme-stream :chat_id="chat_id"></meme-stream>
						</div>
					</b-tab>
					<b-tab title="Top Users" :title-link-class="linkClass(1)">
						<div class="bg-white blabit-border">
							<user-data-chart
								:blabs="blabs"
							>
							</user-data-chart>
						</div>
					</b-tab>
					<b-tab title="Top Words" :title-link-class="linkClass(2)">
						<div class="bg-white blabit-border">
							<word-data-chart
								:blabs="blabs"
							>
							</word-data-chart>
						</div>
					</b-tab>
					<b-tab title="Watching" :title-link-class="linkClass(3)">
						<div class="bg-white blabit-border">
							view all posts of specific users
						</div>
					</b-tab>
					<b-tab title="Mentioned you" :title-link-class="linkClass(4)">
						<div class="bg-white blabit-border">
							view all posts of specific users
						</div>
					</b-tab>
				</b-tabs>
			</div>	
		</div>
		<div class="col-md-5">
		    <div class="blab-container blabit-light-bg blabit-border">
				<div class="justify-content-between d-flex">
					<h1 >Blabs</h1>
					<i class="fa refresh-button m-2" @click="refresh" style="font-size:24px">&#xf021;</i>
				</div>
				<chat-blab-index :chat_id="chat_id" :blabs="blabs"></chat-blab-index>
				<blab-post :blabs="blabs" :chat_id="chat_id"></blab-post>
			</div>
		</div>
    </div>
</template>



<script>
	import UserChart from './UserChart.js';
	import { Tabs } from 'bootstrap-vue/es/components';

	Vue.use(Tabs);
	export default {
		props: {
			chat_id: 		{type: Number, required: true },
			num_viewers: 	{type: Number, required: true}
		},
		data() {
			return {
				mostRecentPost: '',
				blabs: [],
				emptyData: {}
			}
		},
		components: {
			UserChart
		},
		methods: {
			refresh() {
				axios.post('/blabs/requestUpdate/${info}', {chat_id: 		this.chat_id, 
															mostRecentPost: this.mostRecentPost})
					.then(response => {
						this.push(response.data);
					});
			},
			push(newBlabs) {
				for (var i = 0; i < newBlabs.length; i++) {
					this.blabs.unshift(newBlabs[i]);
					this.updateMostRecentPost();
				}
				while (this.blabs.length > 200) {
					this.blabs.pop();

				}

			},
			updateMostRecentPost() {
				if (this.blabs.length > 0) {
					this.mostRecentPost = this.blabs[0].created_at;
				}
			},
			linkClass (idx) {
				if (this.tabIndex === idx) {
					return ['']
					//return ['chat-tab-head-active']
				}
				else {
					return ['']
					//return ['chat-tab-head']
				}
			}
		},
		created() {
			axios.post('/blabs/${chat}', { id: this.chat_id })
				.then(response => {
					this.blabs = response.data;
					this.updateMostRecentPost();
					});
		},
	};
</script>




<style>
	.refresh-button {
		color: black;
	}
	.refresh-button:hover { 
		opacity:0.4;
		cursor: pointer;
	}

</style>
 