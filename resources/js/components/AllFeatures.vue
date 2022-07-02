<template>
    <div>
        <button @click="toggleMenu" class="z-50 fixed w-14 h-14 p-4 right-0 bottom-0 md:top-0">
            <i class="fa-solid fa-magnifying-glass"></i>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7C401.8 87.79 326.8 13.32 235.2 1.723C99.01-15.51-15.51 99.01 1.724 235.2c11.6 91.64 86.08 166.7 177.6 178.9c53.8 7.189 104.3-6.236 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 0C515.9 484.7 515.9 459.3 500.3 443.7zM79.1 208c0-70.58 57.42-128 128-128s128 57.42 128 128c0 70.58-57.42 128-128 128S79.1 278.6 79.1 208z"/></svg>
        </button>
        
        <div class="menu" :class="menuOpen ? 'menu-open' : ''">
            <div class="inline-block">
                <div class="bg-emerald-400 space-y-4 lg:space-y-8 px-2 py-4 lg:p-8">
                    <h3 class="text-center mb-4 lg:mb-8">Zoeken op:</h3>
                        
                    <form @submit.prevent>
                        <div class="space-y-4 lg:space-y-8 px-4">
                            <div v-for="(options, name) in features" :key="name">
                                <single-feature :feature="{ 'name': name, 'options': options }" @select="add" />
                            </div>
                        </div>
                    </form>
                    
                    <div v-if="criteria">
                        <h3 class="text-center mb-4">Zoekcriteria:</h3>
                        
                        <div class="space-y-4 text-xs lg:text-sm">
                            <div v-for="(trait, name) in selected" :key="name">
                                <div v-if="trait.length" class="font-semibold mb-1">{{ getLabel(name) }}:</div>
                                <div class="space-x-1 space-y-1">
                                    <div v-for="(id, index) in trait" :key="index" class="inline-block">
                                        <div class="selected-box">
                                            <a class="btn-remove" @click="remove(name, index)">
                                                <svg class="remove-icon" fill="#388e3c" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="503.021px" height="503.021px" viewBox="0 0 503.021 503.021" style="enable-background:new 0 0 503.021 503.021;" xml:space="preserve">
                                                    <path d="M491.613,75.643l-64.235-64.235c-15.202-15.202-39.854-15.202-55.056,0L251.507,132.222L130.686,11.407 c-15.202-15.202-39.853-15.202-55.055,0L11.401,75.643c-15.202,15.202-15.202,39.854,0,55.056l120.821,120.815L11.401,372.328 c-15.202,15.202-15.202,39.854,0,55.056l64.235,64.229c15.202,15.202,39.854,15.202,55.056,0l120.815-120.814l120.822,120.814 c15.202,15.202,39.854,15.202,55.056,0l64.235-64.229c15.202-15.202,15.202-39.854,0-55.056L370.793,251.514l120.82-120.815 C506.815,115.49,506.815,90.845,491.613,75.643z"/>
                                                </svg>
                                            </a>
                                            
                                            <span class="selected-option">{{ Object.values(features[name][parseInt(id) - 1])[1] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="flex justify-center">
                        <button @click="search" class="">Zoeken</button>
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
                results: null,
                menuOpen: true,
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
            toggleMenu() {
                this.menuOpen = !this.menuOpen;
            },
            
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
                
                    // this.search();
                }
            },
            
            remove(trait, index) {
                this.selected[trait].splice(index, 1);
                
                // this.search();
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
                    this.menuOpen = false;
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
