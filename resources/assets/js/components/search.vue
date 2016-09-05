<template>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Search
                    <div class="pull-right">
                        <div class="btn btn-primary" @click="toggle()" style="margin-top: -5px;">
                            <i v-if="showSearch" class="glyphicon glyphicon-arrow-up"></i>
                            <i v-else class="glyphicon glyphicon-arrow-down"></i>
                        </div>
                    </div>
                </div>
                <div class="panel-body"  v-show="showSearch">
                    <div>

                        <input type="hidden" v-model="lat" name="lat" value=""/>
                        <input type="hidden" v-model="lng" name="lng" value=""/>
                        <input type="hidden" v-model="address" name="address" value=""/>
                        <div class="form-group">
                            <label for="pac-input">Address</label>
                            <input id="pac-input"class="controls form-control" type="text" placeholder="Search Box">
                        </div>
                        <div class="form-group">
                            <label for="radius">Search Radius (km)</label>
                            <input type="number" v-model="radius" id="radius" name="radius" class="controls form-control">
                        </div>
                         <div class="form-group">
                            <button @click="url()" >search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    import {changeUrl} from "../vuex/actions"

    export default {
        data () {
            return {
                lat: 0,
                lng: 0,
                radius: 10,
                address: '',
                showSearch: false
            }
        },
        ready () {
            this.initAutocomplete();
        },
        methods: {
            toggle () {
                this.showSearch = !this.showSearch
            },
            url () {
                var url = `/api/v1/jobs/search?lat=${this.lat}&lng=${this.lng}&radius=${this.radius}`
                this.changeUrl(url)
            },

            initAutocomplete () {
                var that = this;
                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);

                searchBox.addListener('places_changed', function() {
                    var places = searchBox.getPlaces();

                    if (places.length == 0) {
                        return;
                    }

                    places.forEach(function(place) {
                        console.log(place);
                        that.lat = place.geometry.location.lat();
                        that.lng = place.geometry.location.lng();
                        that.address = place.name;
                    });

                });
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
        }
    }
</script>