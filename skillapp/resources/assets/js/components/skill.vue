<template>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="card-title">{{skill_info.name}}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <star-rating  v-model="rating" @rating-selected ="saveRating" > </star-rating>

        </div>
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'

    export default {
        components:{
            StarRating
        },
        props: [
            'skill_info'
        ],
        data() {
            return {
                rating: 0
            }
        },
        mounted() {
            this.rating = this.skill_info.value;
        },
        methods: {
            saveRating(rating) {
                let r = "http://ax.way/skillapp/api/users/" + this.$parent.USER_ID + "/assign-skill-value"; //todo:: get this into laroute or something like that
                axios.post(r, {
                    skill_id: this.skill_info.id,
                    new_value : rating,
                })
                    .then(response => {
                        this.$swal("", "Update complete!", "success")
                    }).catch(()=>{
                        this.$swal("", "Err!", "danger")

                });
            }
        }
    }
</script>
