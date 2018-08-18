<template>
    <div id="markers"></div>
</template>

<script>
    export default {
        props: {
            offices: Array,
            apiKey: String
        },
        data() {
            return {
                data: [['City', 'Beetroots']],
            }
        },
        mounted() {
            this.init();

            const offices = this.data;

            google.charts.load('current', {
                'packages': ['geochart'],
                'mapsApiKey': this.apiKey
            });

            google.charts.setOnLoadCallback(drawMarkersMap);

            function drawMarkersMap() {
                const data = google.visualization.arrayToDataTable(offices);

                const options = {
                    region: 'UA',
                    displayMode: 'markers',
                    colorAxis: { colors: ['#EDB700'] }
                };

                const chart = new google.visualization.GeoChart(document.getElementById('markers'));
                chart.draw(data, options);
            };
        },
        methods: {
            init() {
                this.offices.forEach((office) => {
                    this.data.push([office.city, office.users_count]);
                });
            }
        }
    }
</script>