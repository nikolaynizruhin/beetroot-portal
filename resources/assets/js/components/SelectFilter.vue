<template>
    <div class="form-group">
        <select class="form-control" v-model="selectedField" @change="update">
            <option selected>{{ defaultValue }}</option>
            <option v-for="(item, index) in list" :key="index">{{ item }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: {
            defaultValue: String,
            field: String,
            list: Array
        },
        data() {
            return {
                selectedField: this.defaultValue
            }
        },
        methods: {
            update() {
                this.$emit('update:field', this.selectedField);
            }
        }
    }
</script>