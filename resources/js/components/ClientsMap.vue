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
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': this.apiKey
        });

        google.charts.setOnLoadCallback(this.drawRegionsMap);
    },
    methods: {
        init() {
            this.clients.forEach(client => this.data.push([client.country, client.count]));
        },
        drawRegionsMap() {
            this.init();

            const data = google.visualization.arrayToDataTable(this.data);

            const options = {
                colorAxis: { colors: ['#A51140'] },
            };

            const chart = new google.visualization.GeoChart(document.getElementById('regions'));

            chart.draw(data, options);
        },
    }
}
</script>