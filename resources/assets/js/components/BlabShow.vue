<template>
	<div>
		<a class="link" :href="'/users/'+user_id" >@{{user_id}}</a>
		<small class="date">{{humanReadableDate}}</small>
		<i class="fa edit-button m-2" >&#xf0c9;</i>
		<p class=" message mb-0">{{message}}</p>
	</div>

</template>



<script>
	export default {
		props: ['user_id', 'message', 'created_at'],
		computed: {
			humanReadableDate() {
				return this.$moment.utc(this.created_at).fromNow()
			}
		}
	};

</script>



<style scoped>
	.link {
		font-size: .7em;
	}
	.date {
		font-size: .7em;
		color: grey
	}
	.message {
		font-size: .9em;
	}
	.edit-button {
		float: right;
		font-size: 10px;
		color: #dedede;
	}
	.edit-button:hover {
		color: black;
		cursor: pointer;
	}

</style>