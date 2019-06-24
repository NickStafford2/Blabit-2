<template>
	<div>
		<h2>Top Words</h2>
		<!--ul class="list-group">
			<li class="list-group-item" v-for="word in top3Words"></li>
		</ul-->
		<hr>
    	<word-chart
			:chartData="wordData"
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
        	Ignore punctuation
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
				wordData: null,
				numberOfTopWords: 10,
				ignorePunctuation: true, 
				caseInsensitive: true,
				ignoreList: ['the', 'and', 'it', 'a', 'an'],
				//nextWord: ''
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
    		getKeysWithHighestValue(o, n){				// fix edge cases
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
   		function getKeysWithHighestValue(o, n){				// fix edge cases
				var keys = Object.keys(o);
				keys.sort(function(a,b){
					return o[b] - o[a];
				})
				return keys.slice(0,n);
			}
				console.log('dfds');
				var topWords = {};
				var topKeys = getKeysWithHighestValue(this.words, this.numberOfTopWords);
				for (var i = 0; i < topKeys.length; i++) {
  					topWords[ topKeys[i] ] = words[ topKeys[i] ] ;
				}
        		this.wordData = {
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
				return topWords;
	        },
	        top3Words: function() {
	        	//x = this.getKeysWithHighestValue(this.words, 3);
	        	return {};
				/*	console.log(this.words);
	        	if (this.words.length >= 3) {
	        		return [this.words[0], this.words[1], this.words[2]];
	        	}
	        	else if (this.words.length == 2) {
	        		return [this.words[0], this.words[1]];
	        	}
	        	
	        	else if (this.words.length == 1) {
	        		return [this.words[0]];
	        	}
	        	else return 'no words found';*/
 	        }
		}
	}; 
</script>

