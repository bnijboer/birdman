<template>
    <div class="wrapper">
        <div class="search-container">
            <form @submit.prevent>
                <div class="fields-grid">
                    <div v-for="(options, name) in features" :key="name" style="margin: 20px;">
                        <single-feature :feature="{ 'name': name, 'options': options }" @select="add" />
                    </div>
                </div>
            </form>
            
            <div v-if="criteria">
                <h2 class="mb-4">Zoekcriteria</h2>
                
                <div v-for="(trait, name) in selected" :key="name" class="criteria-container">
                    <div v-if="trait.length" class="criteria-label">
                        <span>{{ getLabel(name) }}:</span>
                    </div>
                    <div v-for="(id, index) in trait" :key="index" class="flex flex-wrap"> 
                        <div class="selected-box">
                            <a class="btn-remove" @click="remove(name, index)">
                                <svg fill="#388e3c" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="503.021px" height="503.021px" viewBox="0 0 503.021 503.021" style="enable-background:new 0 0 503.021 503.021;" xml:space="preserve">
                                    <path d="M491.613,75.643l-64.235-64.235c-15.202-15.202-39.854-15.202-55.056,0L251.507,132.222L130.686,11.407 c-15.202-15.202-39.853-15.202-55.055,0L11.401,75.643c-15.202,15.202-15.202,39.854,0,55.056l120.821,120.815L11.401,372.328 c-15.202,15.202-15.202,39.854,0,55.056l64.235,64.229c15.202,15.202,39.854,15.202,55.056,0l120.815-120.814l120.822,120.814 c15.202,15.202,39.854,15.202,55.056,0l64.235-64.229c15.202-15.202,15.202-39.854,0-55.056L370.793,251.514l120.82-120.815 C506.815,115.49,506.815,90.845,491.613,75.643z"/>
                                </svg>
                            </a>
                            
                            <span class="selected-option">{{ Object.values(features[name][parseInt(id) - 1])[1] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <search-results :results="results" />
    </div>
</template>

<script>
    export default {
        props: ['features'],
        
        data() {
            return {
                selected: {
                    colors: [],
                    behaviors: [],
                    shapes: [],
                    habitats: []
                },
                results: null
            }
        },
        
        computed: {
            criteria() {
                let hasCriteria = false;
                
                for (const [name, values] of Object.entries(this.selected)) {
                    if (values.length > 0) {
                        hasCriteria = true;
                    }
                }
                
                return hasCriteria;
            }
        },
        
        methods: {
            getLabel(trait) {
                let translation;
                
                switch(trait) {
                    case 'colors':
                        translation = 'Kleur';
                    break;
                    case 'behaviors':
                        translation = 'Gedrag';
                    break;
                    case 'shapes':
                        translation = 'Vorm';
                    break;
                    case 'habitats':
                        translation = 'Leefgebied';
                    break;
                }
                
                return translation;
            },
            
            add(event) {
                let trait = Object.keys(event)[0];
                let id = Object.values(event)[0];
                
                if (! this.selected[trait].includes(id)) {
                    this.selected[trait].push(id);
                
                    this.search();
                }
            },
            
            remove(trait, index) {
                this.selected[trait].splice(index, 1);
                
                this.search();
            },
            
            search() {
                let ids;
                let params = [];
                
                for (const [key, values] of Object.entries(this.selected)) {
                    if (values.length) {
                        ids = values.join('+');
                    
                        params.push(`${key}=${ids}`);
                    }
                }
                
                const url = `/birds?${params.join('&')}`;
                
                axios.get(url).then((response) => {
                    this.results = response.data;
                });
            },
            
            getTranslatedFeature(name) {
                let feature;
                
                switch(name) {
                    case 'colors':
                        feature = 'kleur';
                    break;
                    case 'behaviors':
                        feature = 'gedrag';
                    break;
                    case 'shapes':
                        feature = 'vorm';
                    break;
                    case 'habitats':
                        feature = 'leefgebied';
                    break;
                }
                
                if (this.selected[name].length > 1) {
                    feature += 'en';
                }
                
                return feature;
            },
        }
    }
</script>
