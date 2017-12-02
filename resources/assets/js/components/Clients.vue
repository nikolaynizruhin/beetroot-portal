<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Clients {{ filteredClients.length }}
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <select-filter default-value="All Countries"
                                               :field.sync="country"
                                               :list="countries">
                                </select-filter>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="sr-only">Name</label>
                                    <input type="text"
                                           class="form-control"
                                           id="name"
                                           placeholder="Name"
                                           v-model="name">
                                </div>
                            </div>
                        </div>

                        <client-list :clients="filteredClients" :user="user"></client-list>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            clients: Array,
            user: Object
        },
        data() {
            return {
                name: '',
                country: 'All Countries',
            }
        },
        computed: {
            filteredClients() {
                return this.clients.filter(client => this.applyFilters(client));
            },
            countries() {
                let countries = new Set();
                this.clients.map(client => countries.add(client.country));
                return Array.from(countries);
            }
        },
        methods: {
            applyFilters(client) {
                return (
                    this.applyCountryFilter(client) && this.applyNameFilter(client)
                );
            },
            applyCountryFilter(client) {
                return this.country === 'All Countries' ? true : client.country === this.country;
            },
            applyNameFilter(client) {
                return client.name.toLowerCase().includes(this.name.toLowerCase());
            }
        }
    }
</script>
