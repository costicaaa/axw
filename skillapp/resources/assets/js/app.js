
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
import Treeselect from "./components/treeselect.vue";
import Treeselectmultiple from "./components/treeselectmultiple.vue";
import skill from "./components/skill.vue";
import Vue from 'vue'
import VueSwal from 'vue-swal'

Vue.use(VueSwal)
if( $("#assignskills").length > 0 )
{
    let assignskills = new Vue({
        el: '#assignskills',
        components: {
            Treeselect,
            Treeselectmultiple,
            skill
        },
        refs: [
           "USER_ID"
        ],
        data: {
            loaded: false,
            cici: null,
            valueConsistsOf: 'ALL',
            optionss: [],
            allSkills: [],
            assignedSkills: [],
            USER_ID: null,
        },
        methods: {
            getAllSkillsByCat(){
                let r = "http://ax.way/skillapp/api/skills/grouped_by_categories"; //todo:: get this into laroute or something like that
                axios.get(r)
                    .then(response => {
                        this.optionss = response.data;
                        this.loaded = true;
                    }).catch();
            },
            getUserSkills(){
                let r = "http://ax.way/skillapp/api/skills/by_user/" + this.USER_ID; //todo:: get this into laroute or something like that
                axios.get(r)
                    .then(response => {
                        this.assignedSkills = response.data;
                    }).catch();
            },
            addNewSkill(skill_id){
                let r = "http://ax.way/skillapp/api/skills/" + skill_id + "/" + this.USER_ID;
                axios.get(r)
                    .then(response => {
                        this.assignedSkills.push(response.data);
                    }).catch();
            }
        },
        mounted(){
            this.USER_ID = document.getElementById("USER_ID").value;
            this.getUserSkills();
            this.getAllSkillsByCat();
            this.$on("value_updated", (value) => {
                if(typeof value !== "number") return;
                if(this.assignedSkills.indexOf(value) !== -1)
                {
                    return;
                }
                this.addNewSkill(value);

            });



        }
    });
}


if( $("#searchskillset").length > 0 )
{
    let searchskillset = new Vue({
        el: '#searchskillset',
        components: {
            Treeselectmultiple,
        },
        data: {
            loaded: false,
            found: false,
            users: [],
            search_skills: null,
        },
        methods: {
            getAllSkillsByCat(){
                let r = "http://ax.way/skillapp/api/skills/grouped_by_categories"; //todo:: get this into laroute or something like that
                axios.get(r)
                    .then(response => {
                        this.optionss = response.data;
                        this.loaded = true;
                    }).catch();
            },
            search(){
                let r = "http://ax.way/skillapp/api/skills/search_user_by_skill_set"; //todo:: get this into laroute or something like that
                if(this.search_skills.length === 0)
                {
                    this.$swal("", "Please select something to search for.", "warning");
                    return;
                }
                axios.post(r, {
                    skill_set: this.search_skills
                })
                    .then(response => {

                        this.users = response.data.users;
                        this.found = response.data.found;
                        if(this.found === false)
                        {
                            this.$swal("", "Sorry. We did not find any results from your search.", "error")
                        }
                    }).catch();
            },

        },
        mounted(){
            this.getAllSkillsByCat();
            this.$on("value_updated", (value) => {
                this.search_skills = value;
            });



        }
    });
}

