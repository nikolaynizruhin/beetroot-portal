<template>
    <div id="regions" />
</template>

<script>
export default {
    props: {
        clients: {
            type: Array,
            default: () => [],
        },
        apiKey: {
            type: String,
            default: '',
        }
    },
    data() {
        return {
            data: [['Country', 'Teams']],
        }
    },
    mounted() {
        this.init();

        const clients = this.data;

        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': this.apiKey
        });

        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            const data = google.visualization.arrayToDataTable(clients);

            const options = {
                colorAxis: { colors: ['#A51140'] },
            };

            const chart = new google.visualization.GeoChart(document.getElementById('regions'));

            chart.draw(data, options);
        }
    },
    methods: {
        init() {
            this.clients.forEach((client) => {
                this.data.push([client.country, client.count]);
            });
        }
    }
}
</script>