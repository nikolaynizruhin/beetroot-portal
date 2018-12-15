<template>
    <canvas />
</template>

<script>
export default {
    props: {
        usersPerYear: {
            type: Object,
            default: () => {},
        }
    },
    data() {
        return {
            label: 'Beetroots',
            labels: [],
            data: [],
            borderColor: '#A51140',
            pointBackgroundColor: '#FFF',
        }
    },
    mounted() {
        this.init();

        new Chart(this.$el, {
            type: 'line',
            data: {
                labels: this.labels,
                datasets: [{
                    label: this.label,
                    data: this.data,
                    borderColor: this.borderColor,
                    pointBackgroundColor: this.pointBackgroundColor,
                    fill: false
                }],
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }
        });
    },
    methods: {
        init() {
            for (const year in this.usersPerYear) {
                this.labels.push(year);
                this.data.push(this.usersPerYear[year]);
            }
        }
    }
}
</script>