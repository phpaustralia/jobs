<template>

<div class="row">
     <div class="pull-right" v-if="searching">
                <div class="btn btn-default" @click="clearSearch">
                    clear search
                </div>
            </div>
</div>
    <div class="row">
        <div v-if="this.jobs.length == 0">
            <h1>No Jobs Found</h1>
        </div>
        <div v-else>
            <div class="media" v-for="job in jobs">
                <hr>
                <a href="/jobs/{{job.id}}">
                    <div class="media-left">
                        <!--<img class="media-object" src="{{job.image}}" alt="">-->
                    </div>

                    <div class="media-body">
                        <h4 class="media-heading">{{job.title}}</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-sm-push-3">
                <ul class="pager">
                    <li class="previous" v-show="pagination.prev_page_url">
                        <a class="page-scroll" v-on:click="previous" href="#">Previous</a>
                    </li>
                    <li>
                        {{ pagination.current_page }} of {{ pagination.last_page }}
                    </li>
                    <li class="next" v-show="pagination.next_page_url">
                        <a class="page-scroll" v-on:click="next" href="#">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>
    import {changeUrl} from "../vuex/actions"
    export default {

        props: ['base_url'],

        data () {
            return {
                jobs: [],
                searching: false,
                pagination: {
                    total: null,
                    per_page: null,
                    current_page: null,
                    last_page: null,
                    next_page_url: null,
                    prev_page_url: null,
                    from: null,
                    to: null
                }
            }
        },
        ready() {
           this.get(this.base_url)

        },
        calculated: {
            noJobs () {
                return this.jobs.length == 0;
            }
        },

        vuex: {
            state: {
                searchUrl: function(state) {
                    return state.searchUrl
                }
            },
            actions: {
                changeUrl
            }
        },

        watch: {
            searchUrl (url) {
                this.get(url);
                this.searching = true;
            }
        },

        methods: {
            clearSearch () {
                this.get(this.base_url)
                this.searching = false
            },
            next (e) {
                e.preventDefault();
                this.get(this.pagination.next_page_url);
            },
            previous (e) {
                e.preventDefault();
                this.get(this.pagination.prev_page_url);
            },

            get(url) {

                this.$http.get(url).then( (response) => {
                    const res = response.json();
                    this.$set('jobs', res.data)
                    this.pagination.total = res.total
                    this.pagination.per_page = res.per_page
                    this.pagination.current_page = res.current_page
                    this.pagination.last_page = res.last_page
                    this.pagination.next_page_url = res.next_page_url
                    this.pagination.prev_page_url = res.prev_page_url
                    this.pagination.from = res.from
                    this.pagination.to = res.to

                })
            }
        }
    }
</script>