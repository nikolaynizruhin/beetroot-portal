<template>
    <canvas />
</template>

<script>
export default {
    props: {
        tags: {
            type: Array,
            default: () => [],
        }
    },
    data () {
        return {
            labels: [],
            usersCount: [],
            usersColor: '224, 98, 135',
            clientsCount: [],
            clientsColor: '227, 227, 221',
            pointBorderColor: 'white',
        }
    },
    mounted() {
        this.init();

        new Chart(this.$el, {
            type: 'radar',
            data: {
                labels: this.labels,
                datasets: [
                    {
                        label: 'Beetroots',
                        backgroundColor: `rgba(${this.usersColor}, 0.1)`,
                        borderColor: `rgb(${this.usersColor})`,
                        pointBackgroundColor: `rgb(${this.usersColor})`,
                        pointBorderColor: this.pointBorderColor,
                        data: this.usersCount,
                    },
                    {
                        label: 'Teams',
                        backgroundColor: `rgba(${this.clientsColor}, 0.1)`,
                        borderColor: `rgb(${this.clientsColor})`,
                        pointBackgroundColor: `rgb(${this.clientsColor})`,
                        pointBorderColor: this.pointBorderColor,
                        data: this.clientsCount,
                    }
                ]
            },
        });
    },
    methods: {
        init() {
            this.tags.forEach(tag => {
                this.labels.push(tag.name);
                this.usersCount.push(tag.users_count);
                this.clientsCount.push(tag.clients_count);
            });
        },
    },
}
</script>