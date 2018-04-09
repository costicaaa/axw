<!-- Vue component -->
<template>
    <treeselect
            :multiple="true"
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
            valueConsistsOf: "ALL",
            multiple: true,
            clearable: true,
            searchable: true,
            disabled: false,
            openOnClick: true,
            openOnFocus: false,
            clearOnSelect: true,
            closeOnSelect: false,
            alwaysOpen: false,
            value: null,
        }),
        watch: {
            multiple(newValue) {
                if (newValue) {
                    this.value = this.value ? [ this.value ] : []
                } else {
                    this.value = this.value[0]
                }
            },
            value(){
                this.$parent.$emit("value_updated", this.value);
            }

        },
        props: ['optionss'],
        mounted(){

        }

    }
</script>

<style src="@riophae/vue-treeselect/dist/vue-treeselect.min.css"></style>