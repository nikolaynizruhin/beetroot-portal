<template>
    <div class="modal fade"
         :id="`userModal${user.id}`"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button"
                            class="close pull-right"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <img :src="`storage/${user.avatar}`"
                         alt="Avatar"
                         class="img-thumbnail img-circle img-responsive center-block"
                         width="150"
                         height="150">

                    <h3 class="text-center">{{ user.name }}</h3>

                    <h4 class="text-center"><em>{{ user.position }}</em></h4>

                    <br>

                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-1">
                            <p>
                                <a :href="`mailto:${user.email}`">
                                    <i aria-hidden="true" class="fa fa-envelope-o fa-fw"></i>
                                    &nbsp;
                                    {{ user.email }}
                                </a>
                            </p>
                            <p v-if="user.phone">
                                <a :href="`tel:${user.phone}`">
                                    <i aria-hidden="true" class="fa fa-phone fa-fw"></i>
                                    &nbsp;
                                    {{ user.phone }}
                                </a>
                            </p>
                            <p>
                                <i aria-hidden="true" class="fa fa-slack fa-fw"></i>
                                &nbsp;
                                {{ user.slack }}
                            </p>
                            <p v-if="user.skype">
                                <a :href="`skype:${user.skype}?userinfo`">
                                    <i aria-hidden="true" class="fa fa-skype fa-fw"></i>
                                    &nbsp;
                                    {{ user.skype }}
                                </a>
                            </p>
                            <p v-if="user.github">
                                <a :href="`https://github.com/${user.github}`" target="_blank">
                                    <i aria-hidden="true" class="fa fa-github fa-fw"></i>
                                    &nbsp;
                                    {{ user.github }}
                                </a>
                            </p>
                        </div>
                        <div class="col-sm-5">
                            <p>
                                <i aria-hidden="true" class="fa fa-handshake-o fa-fw"></i>
                                &nbsp;
                                {{ user.client.name }}
                            </p>
                            <p>
                                <i aria-hidden="true" class="fa fa-birthday-cake fa-fw"></i>
                                &nbsp;
                                {{ user.birthday | date }}
                            </p>
                            <p>
                                <i aria-hidden="true" class="fa fa-map-marker fa-fw"></i>
                                &nbsp;
                                {{ user.office.city }}
                            </p>
                        </div>
                    </div>
                    <br>
                    <div v-if="user.bio" class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                            <p>{{ user.bio }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object
        },
        filters: {
            date(date) {
                return moment(date).format('DD-MM-YYYY');
            }
        },
    }
</script>