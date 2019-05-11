<template>
    <canvas />
</template>

<script>
export default {
    props: {
        genders: {
            type: Array,
            default: () => [],
        }
    },
    data() {
        return {
            labels: [],
            data: [],
            backgroundColor: [],
        }
    },
    mounted() {
        this.init();

        new Chart(this.$el, {
            type: 'pie',
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
            this.genders.forEach(gender => {
                this.data.push(gender.count);
                this[`set${this.capitalizeFirstLetter(gender.gender)}Data`]();
            });
        },
        setMaleData() {
            this.labels.push('Beetboys');
            this.backgroundColor.push('#7D6378');
        },
        setFemaleData() {
            this.labels.push('Beetgirls');
            this.backgroundColor.push('#EDB700');
        },
        capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    }
}
</script>