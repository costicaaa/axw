<!-- Vue component -->
<template>
    <treeselect
            :multiple="false"
            :options="optionss"
            :value-consists-of="valueConsistsOf"
            v-model="value"
            :disable-branch-nodes="true"
            :clear-on-select="true"
    />
</template>

<script>
    import Treeselect from '@riophae/vue-treeselect'


    export default {
        components: {
            Treeselect
        },

        data: () => ({
            multiple: true,
            value: null,
            valueConsistsOf: 'ALL',
        }),
        watch: {
            value(newValue) {
                this.$parent.$emit("value_updated", this.value);
            },
        },
        props: ['optionss'],
        mounted(){

        }

    }
</script>

<style src="@riophae/vue-treeselect/dist/vue-treeselect.min.css"></style>