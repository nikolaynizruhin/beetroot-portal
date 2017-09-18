<template>
    <canvas></canvas>
</template>

<script>
    export default {
        mounted() {
            new Chart(this.$el, {
                type: 'doughnut',
                data: {
                    labels: ["Python", "JavaScript", "PHP", "Golang", "C++"],
                    datasets: [{
                        data: [35, 28, 25, 10, 5],
                        backgroundColor: [
                            '#BC204B',
                            '#7C8483',
                            '#71A2B6',
                            '#60B2E5',
                            '#53F4FF',
                        ],
                    }],
                },
            });
        }
    }
</script>