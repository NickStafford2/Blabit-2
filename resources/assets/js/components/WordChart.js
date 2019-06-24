import {Bar, mixins} from 'vue-chartjs'

const { reactiveProp } = mixins

export default {
    mixins: [reactiveProp],
    extends: Bar,
    mounted () {
        this.renderChart(this.data, this.options)

    },
    props: {
    	//data: {required: true}
    },
    data() {
        return {
            dataCollection: {},
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