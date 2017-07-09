<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Clients ({{ filteredClients.length }})
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <select-filter default-value="All Locations" :field.sync="location" :list="locations"></select-filter>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="sr-only">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" v-model="name">
                                </div>
                            </div>
                        </div>

                        <client-list :clients="filteredClients"></client-list>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            clients: Array
        },
        data() {
            return {
                name: '',
                location: 'All Locations',
            }
        },
        computed: {
            filteredClients() {
                return this.clients.filter(client => this.applyFilters(client));
            },
            locations() {
                let locations = new Set();
                this.clients.map(client => locations.add(client.location));
                return Array.from(locations);
            }
        },
        methods: {
            applyFilters(client) {
                return (
                    this.applyLocationFilter(client) && this.applyNameFilter(client)
                );
            },
            applyLocationFilter(client) {
                return this.location === 'All Locations' ? true : client.location === this.location;
            },
            applyNameFilter(client) {
                return client.name.toLowerCase().includes(this.name.toLowerCase());
            }
        }
    }
</script>
