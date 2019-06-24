<template>
	<div>
		<word-chart
			:chartData="chartData"
			:width="500"
			:height="500"
		>
		</word-chart>
		<hr>
		<p>Number of Words</p>
		<number-input v-model="numberOfTopWords" :min="1" :max="30" inline controls></number-input>
		<hr>
		<p-check class="p-icon p-round p-pulse" color="success" v-model="ignorePunctuation">
			<i slot="extra" class="icon mdi mdi-check"></i>
			Ignore punctuation
		</p-check>
		<p-check class="p-icon p-round p-pulse" color="success" v-model="caseInsensitive">
			<i slot="extra" class="icon mdi mdi-check"></i>
			Ignore Capitalization
		</p-check>
		<hr>
		<h3>Ignore List</h3>
		<text-input  placeholder="add word to ignore" @inputSubmit="addToIgnoreList($event)"></text-input>
		<ul class="list-group">
			<li class="list-group-item" v-for="word in ignoreList">
				<p-check class="p-default p-curve" name="color" color="danger-o">{{word}}</p-check>
			</li>
		</ul>
	</div>
</template>

<script>
	import WordChart from './WordChart.js';
	import VueNumberInput from '@chenfengyuan/vue-number-input';

	Vue.component(VueNumberInput.name, VueNumberInput);
	import PrettyInput from 'pretty-checkbox-vue/input';
	import PrettyCheck from 'pretty-checkbox-vue/check';
	import PrettyRadio from 'pretty-checkbox-vue/radio';

	Vue.component('p-input', PrettyInput);
	Vue.component('p-check', PrettyCheck);
	Vue.component('p-radio', PrettyRadio);

	export default {
		props: {
			blabs: 		{required: true}
		},
		data() {
			return {
				numberOfTopWords: 10,
				ignorePunctuation: true, 
				caseInsensitive: true,
				ignoreList: ['the', 'and', 'it', 'a', 'an', 'i'],
			}
		},
		components: {
			WordChart
		},
		methods: {
			addToIgnoreList(e) {
			if (!this.ignoreList.includes(e)) {
				e = this.editCase(e);
				e = this.editPunctuation(e);
				if (e != ' ' ) {
					this.ignoreList.push(e);
				}
			}
			},

			editCase(s) {
				if (this.caseInsensitive) {
					s = s.toLowerCase();
				}
				return s;
			},
			editPunctuation(s) {
				if (this.ignorePunctuation) {
					// remove punctuation
					s = s.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g,"");

					// remove whitespace that resulted from removed punctuation
					s = s.replace(/\s{2,}/g," ");
				}
				return s;
			},
			getKeysWithHighestValue(o, n){
				var keys = Object.keys(o);
				keys.sort(function(a,b){
					return o[b] - o[a];
				})
				return keys.slice(0,n);
			}
		},
		computed: {
			words: function() {
				var words = {};
				var count = 0;
				for (let blab of this.blabs) {
					count++;
					var message = blab.message;
					message = this.editCase(message);
					message = this.editPunctuation(message);

					message = message.split(" ");

					for (let word of message) {

						if (word in words) {
							words[word]++;
						}
						else {
							words[word] = 1;
						}
					}
				}

				for (let ignoreWord of this.ignoreList){
					if (ignoreWord in words) {
						delete words[ignoreWord];
					}
				}
				return words
			},
			chartData: function() {
				var topWords = {};
				var topKeys = this.getKeysWithHighestValue(this.words, this.numberOfTopWords);
				for (var i = 0; i < topKeys.length; i++) {
						topWords[ topKeys[i] ] = this.words[ topKeys[i] ] ;
				}

				if (Object.keys(topWords).length == 0) {
					return null
				}
				else {
					var x = {
						// Data for the y-axis of the chart
						labels: Object.keys(topWords),
						datasets: [
							{
								label: 'Words',
								backgroundColor: '#f87979',
								// Data for the x-axis of the chart
								data: Object.values(topWords)
							}
						]
					}
					return x
				}
			}
		}
	}; 
</script>

