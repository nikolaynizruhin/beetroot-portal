<template>
    <div id="regions"></div>
</template>

<script>
    export default {
        props: {
            clients: Array,
            apiKey: String
        },
        data() {
            return {
                data: [['Country', 'Clients']],
            }
        },
        mounted() {
            this.init();

            let clients = this.data;

            google.charts.load('current', {
                'packages': ['geochart'],
                'mapsApiKey': this.apiKey
            });

            google.charts.setOnLoadCallback(drawRegionsMap);

            function drawRegionsMap() {
                const data = google.visualization.arrayToDataTable(clients);

                const options = {
                    colorAxis: { colors: ['#BC204B'] },
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