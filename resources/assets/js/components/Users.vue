<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Employees {{ filteredUsers.length }}
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <select-filter :default-value="defaultOffice"
                                               :field.sync="office"
                                               :list="offices"/>
                            </div>

                            <div class="col-sm-3">
                                <select-filter :default-value="defaultPosition"
                                               :field.sync="position"
                                               :list="positions"/>
                            </div>

                            <div class="col-sm-3">
                                <select-filter :default-value="defaultClient"
                                               :field.sync="client"
                                               :list="clients"/>
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

                        <user-list :users="filteredUsers" :auth-user="user"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            users: Array,
            user: Object
        },
        data() {
            return {
                defaultClient: 'All Clients',
                defaultOffice: 'All Cities',
                defaultPosition: 'All Positions',
                client: 'All Clients',
                office: 'All Cities',
                position: 'All Positions',
                name: ''
            }
        },
        computed: {
            filteredUsers() {
                return this.users.filter(user => this.applyFilters(user));
            },
            clients() {
                let clients = this.users.map(user => user.client.name);
                return [...new Set(clients)];
            },
            offices() {
                let offices = this.users.map(user => user.office.city);
                return [...new Set(offices)];
            },
            positions() {
                let positions = this.users.map(user => user.position);
                return [...new Set(positions)];
            }
        },
        methods: {
            applyFilters(user) {
                return (
                    this.applyClientFilter(user) &&
                    this.applyOfficeFilter(user) &&
                    this.applyPositionFilter(user) &&
                    this.applyNameFilter(user)
                );
            },
            applyClientFilter(user) {
                return this.client === this.defaultClient ? true : user.client.name === this.client;
            },
            applyOfficeFilter(user) {
                return this.office === this.defaultOffice ? true : user.office.city === this.office;
            },
            applyPositionFilter(user) {
                return this.position === this.defaultPosition ? true : user.position === this.position;
            },
            applyNameFilter(user) {
                return user.name.toLowerCase().includes(this.name.toLowerCase());
            }
        }
    }
</script>
