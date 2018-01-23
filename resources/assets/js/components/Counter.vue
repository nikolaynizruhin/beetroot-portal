<template>
    <span>{{ number }}</span>
</template>

<script>
    export default {
        props: {
            count: Number,
        },
        data() {
            return {
                number: 0,
                interval: null
            }
        },
        mounted() {
            this.interval = setInterval(() => {
                let change = (this.count - this.number) / 10;

                change = change >= 0 ? Math.ceil(change) : Math.floor(change);

                this.number = this.number + change;

                if (this.number === this.count) clearInterval(this.interval);
            }, 20);
        }
    }
</script>