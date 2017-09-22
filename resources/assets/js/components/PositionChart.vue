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
                backgroundColor: ['#BC204B', '#7C8483', '#71A2B6', '#60B2E5', '#53F4FF'],
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