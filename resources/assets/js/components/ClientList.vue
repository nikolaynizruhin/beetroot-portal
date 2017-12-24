<template>
    <div class="list-group">
        <div class="row list-group-item" v-for="client in clients" :key="client.id">
            <div class="col-sm-4">
                <img :src="`storage/${client.logo}`"
                     alt="Logo"
                     class="img-thumbnail img-circle img-responsive center-block"
                     width="150"
                     height="150">
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-12">
                        <p>
                            <strong>{{ client.name }}</strong>
                            &nbsp;
                            <a v-if="user.is_admin" :href="`clients/${client.id}/edit`">
                                <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            </a>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <p>
                            <a target="_blank" :href="client.site">
                                <i class="fas fa-globe fa-fw" aria-hidden="true"></i>
                                &nbsp;
                                {{ client.site }}
                            </a>
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p>
                            <i class="fas fa-map-marker-alt fa-fw" aria-hidden="true"></i>
                            &nbsp;
                            {{ client.country }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p><em>{{ client.description }}</em></p>
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
        }
    }
</script>