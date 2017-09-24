<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-id-card-o fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Employees ({{ filteredUsers.length }})
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <select-filter default-value="All Cities" :field.sync="office" :list="offices"></select-filter>
                            </div>
                            <div class="col-sm-3">
                                <select-filter default-value="All Positions" :field.sync="position" :list="positions"></select-filter>
                            </div>
                            <div class="col-sm-3">
                                <select-filter default-value="All Clients" :field.sync="client" :list="clients"></select-filter>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name" class="sr-only">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Name" v-model="name">
                                </div>
                            </div>
                        </div>

                        <user-list :users="filteredUsers" :authUser="user"></user-list>

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
                name: '',
                client: 'All Clients',
                office: 'All Cities',
                position: 'All Positions'
            }
        },
        computed: {
            filteredUsers() {
                return this.users.filter(user => this.applyFilters(user));
            },
            clients() {
                let clients = new Set();
                this.users.map(user => clients.add(user.client.name));
                return Array.from(clients);
            },
            offices() {
                let offices = new Set();
                this.users.map(user => offices.add(user.office.city));
                return Array.from(offices);
            },
            positions() {
                let positions = new Set();
                this.users.map(user => positions.add(user.position));
                return Array.from(positions);
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
                return this.client === 'All Clients' ? true : user.client.name === this.client;
            },
            applyOfficeFilter(user) {
                return this.office === 'All Cities' ? true : user.office.city === this.office;
            },
            applyPositionFilter(user) {
                return this.position === 'All Positions' ? true : user.position === this.position;
            },
            applyNameFilter(user) {
                return user.name.toLowerCase().includes(this.name.toLowerCase());
            }
        }
    }
</script>
