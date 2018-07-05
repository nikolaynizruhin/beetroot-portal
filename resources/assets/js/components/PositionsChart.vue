<template>
    <canvas></canvas>
</template>

<script>
    export default {
        props: {
            positions: Array
        },
        data() {
            return {
                labels: [],
                data: [],
                backgroundColor: [
                    '#A51140',
                    '#E06287',
                    '#E3E3DD',
                    '#EDB700',
                    '#7D6378'
                ],
            }
        },
        mounted() {
            this.init();

            new Chart(this.$el, {
                type: 'doughnut',
                data: {
                    labels: this.labels,
                    datasets: [{
                        data: this.data,
                        backgroundColor: this.backgroundColor,
                    }],
                },
                options: {
                    legend: {
                        position: 'left'
                    }
                }
            });
        },
        methods: {
            init() {
                this.positions.forEach(position => {
                    this.labels.push(position.title);
                    this.data.push(position.count);
                });
            }
        }
    }
</script>