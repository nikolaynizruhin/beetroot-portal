<template>
    <div id="markers" />
</template>

<script>
export default {
    props: {
        offices: {
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
            data: [['City', 'Beetroots']],
        }
    },
    mounted() {
        google.charts.load('current', {
            'packages': ['geochart'],
            'mapsApiKey': this.apiKey
        });

        google.charts.setOnLoadCallback(this.drawMarkersMap);
    },
    methods: {
        init() {
            this.offices.forEach(office => this.data.push([office.city, office.users_count]));
        },
        drawMarkersMap() {
            this.init();

            const data = google.visualization.arrayToDataTable(this.data);

            const options = {
                region: 'UA',
                displayMode: 'markers',
                colorAxis: { colors: ['#EDB700'] }
            };

            const chart = new google.visualization.GeoChart(document.getElementById('markers'));

            chart.draw(data, options);
        }
    }
}
</script>