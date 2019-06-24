<template>
    <div class="bg-light">
        <div style="overflow:hidden">
            <div ref="blabContainer" class="blabContainer">
                <ul class="list-group">
                    <li class="list-group-item p-1" v-for="blab in reversedBlabs">
						<blab-show :user_id="blab.user_id" :message="blab.message" :created_at="blab.created_at"></blab-show>
                    </li>
                </ul>
            </div>
        </div>
	</div>
</template>



<script>
	export default {
		props: ['chat_id', 'blabs'], 

		updated() {
			console.log('mounted');
			this.scrollToEnd();
		},
		methods: {
			scrollToEnd: function() {
				var container = this.$refs.blabContainer;
				container.scrollTop = container.scrollHeight;
			}
		},
		computed: {
    		reversedBlabs() {
        		return this.blabs.slice().reverse();
  			}
		}
	};

</script>




<style scoped>
	.blabContainer {
		height:400px;  
		max-height:400px; 
		min-height: 400px;
		overflow-y:scroll;
	}

</style>