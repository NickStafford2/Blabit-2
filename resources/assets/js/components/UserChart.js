import {Bar, mixins} from 'vue-chartjs'

export default {
    mixins: [mixins.reactiveProp],

    extends: Bar,
    mounted () {
        //debugger
        this.renderChart(this.data, this.options);
    },
    update() {
        //debugger
        //console.log('UserChart.js update()');
    },
    props: {
    	//data: {required: true}
    },
    data() {
        return {
            options: {
                responsive: false, 
                maintainAspectRatio: false,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                min: 0
                            }
                        }
                    ]
                }
            }
        }
    }
}