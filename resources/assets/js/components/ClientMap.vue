<template>
    <div id="regions"></div>
</template>

<script>
    export default {
        mounted() {
            google.charts.load('current', {
                'packages': ['geochart'],
                'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
            });

            google.charts.setOnLoadCallback(drawRegionsMap);

            function drawRegionsMap() {
                const data = google.visualization.arrayToDataTable([
                    ['Country', 'Clients'],
                    ['Germany', 2],
                    ['United States', 3],
                    ['Brazil', 4],
                    ['Canada', 5],
                    ['France', 6],
                    ['Russia', 3],
                    ['Sweden', 7]
                ]);

                const options = {
                    colorAxis: {colors: ['#BC204B']},
                };

                const chart = new google.visualization.GeoChart(document.getElementById('regions'));

                chart.draw(data, options);
            }
        }
    }
</script>