<template>
	<div>
		user data chart
		<user-chart
			:chartData="chartData"
			:height="chartSize"
			:width="chartSize"
		>
		</user-chart>
		<number-input 
			v-model="numUsersShown" 
			:min="0" 
			:max="maxUsersOnChart" 
			inline 
			controls
			>
			</number-input>
	</div>
</template>

<script>
	import UserChart from './UserChart.js';
	import VueNumberInput from '@chenfengyuan/vue-number-input';

	Vue.component(VueNumberInput.name, VueNumberInput);

	export default {
		props: {
			blabs: 		{required: true},
		},
		
		data() {
			return {
				chartSize: 500,
				numUsersShown: 0,
				initialDataCollected: false
			}
		},
		components: {
			UserChart
		},
		methods: {
			min(a,b) {
				if (a < b) {
					return a
				}
				else return b
			},
			getKeysWithHighestValue(o, n){
				if (n <= 0) {
					return null
				}
				else {
					var keys = Object.keys(o);
					keys.sort(function(a,b){
						return o[b] - o[a];
					})
					return keys.slice(0,n);
				}
			}
		},
		computed: {
			users: function() {
				//console.log('users called')
				//console.log(this.blabs)
				//debugger
				if (this.blabs === null) {
					return null
				}
				if (this.blabs.length === 0) {
					return null
				}
				else {
					var users = {};
					for (let blab of this.blabs) {
						var key = blab.user_id;

						if (key in users) {
							users[key]++;
						}
						else {
							users[key] = 1;
						}
					}
					// set initial data only once. 
					if (this.initialDataCollected === false) {
						this.initialDataCollected = true;
						this.numUsersShown = this.min(Object.keys(this.users).length, 15)
					}
					return users
				}
			},
			topUsers: function() {
				//debugger
				//console.log('topUsers called')
				//console.log(this.users)
				if (this.users === null) {
					return null
				}
				else {
					//debugger
					//debugger
					this.maxUsersOnChart
					var topUsers = {};
					var topKeys = this.getKeysWithHighestValue(this.users, this.numUsersShown);
					for (var i = 0; i < this.numUsersShown; i++) {
						topUsers[ topKeys[i] ] = this.users[ topKeys[i] ] ;
					}
					return topUsers
				}
			},
			chartData: function() {
				//debugger
				//console.log('chartData called')
				/*if (Object.keys(this.topUsers).length == 0)	{
					return null;
				}
				*/
				if (this.topUsers === null) {
					return null
				}
				else {
					return {
						labels: Object.keys(this.topUsers),
						datasets: [
							{
								label: 'Number of Posts',
								backgroundColor: '#f87979',
								// Data for the x-axis of the chart
								data: Object.values(this.topUsers)
							}	
						]
					}
				}
			},
			maxUsersOnChart: function() {
				//console.log('maxUsersOnChart called')
				if (this.users === null) {
					return 0
				}
				else {
					return this.min(Object.keys(this.users).length, 30)
				}
			},
			/*
			minUsersOnChart: function() {
				return this.min(Object.keys(this.users).length, 1)
			}
			*/
			
			/*
			numUsersShown: function() {
				return this.min(Object.keys(this.users).length, this.numUsersShown)
			}
			*/
		},
		created() {
			//debugger
		}

	};
</script>