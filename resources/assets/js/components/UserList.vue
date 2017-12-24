<template>
    <div class="list-group">
        <div class="row list-group-item" v-for="user in users" :key="user.id">
            <user-modal :user="user"/>
            <div class="col-sm-4">
                <a href="#" data-toggle="modal" :data-target="`#userModal${user.id}`">
                    <img :src="`storage/${user.avatar}`"
                         alt="Avatar"
                         class="img-thumbnail img-circle img-responsive center-block"
                         width="150"
                         height="150">
                </a>
            </div>

            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            <strong>
                                <a href="#" data-toggle="modal" :data-target="`#userModal${user.id}`">
                                    {{ user.name }}
                                </a>
                            </strong>
                            &nbsp;
                            <a v-if="authUser.is_admin" :href="`users/${user.id}/edit`">
                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
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
                            <i class="far fa-handshake fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.client.name }}
                        </p>
                        <p>
                            <i class="far fa-envelope fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.email }}
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <i class="fas fa-birthday-cake fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ user.birthday | date }}
                        </p>
                        <p>
                            <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
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