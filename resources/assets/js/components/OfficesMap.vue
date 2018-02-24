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
                data: [['City', 'Employees']],
            }
        },
        mounted() {
            this.init();

            let offices = this.data;

            google.charts.load('current', {
                'packages': ['geochart'],
                'mapsApiKey': this.apiKey
            });

            google.charts.setOnLoadCallback(drawMarkersMap);

            function drawMarkersMap() {
                var data = google.visualization.arrayToDataTable(offices);

                var options = {
                    region: 'UA',
                    displayMode: 'markers',
                    colorAxis: { colors: ['#f1b828'] }
                };

                var chart = new google.visualization.GeoChart(document.getElementById('markers'));
                chart.draw(data, options);
            };
        },
        methods: {
            init() {
                this.offices.forEach((office) => {
                    this.data.push([office.city, office.employee_count]);
                });
            }
        }
    }
</script>