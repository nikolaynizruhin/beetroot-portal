<template>
    <div class="list-group">
        <div class="row list-group-item" v-for="user in users">
            <user-modal :user="user"></user-modal>
            <div class="col-sm-4">
                <img :src="'storage/' + user.avatar" alt="Avatar" class="img-thumbnail img-circle img-responsive center-block" width="150" height="150">
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            <strong>
                                <a href="#" data-toggle="modal" :data-target="'#userModal' + user.id">
                                    {{ user.name }}
                                </a>
                            </strong>
                            &nbsp;
                            <a v-if="authUser.is_admin" :href="'users/' + user.id + '/edit'">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p><em>{{ user.position }}</em></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>
                            <i class="fa fa-handshake-o fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.client.name }}
                        </p>
                        <p>
                            <i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.email }}
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <i class="fa fa-birthday-cake fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.birthday | date }}
                        </p>
                        <p>
                            <i class="fa fa-map-marker fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.office.city }}
                        </p>
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
            authUser: Object
        },
        filters: {
            date(date) {
                return moment(date).format('DD-MM-YYYY');
            }
        },
    }
</script>