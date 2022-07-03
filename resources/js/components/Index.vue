<template>
    <div>
        <button @click="toggleMenu" class="z-50 fixed w-14 h-14 p-4 right-0 bottom-0 md:top-0">
            <i class="fa-solid fa-2xl text-gray-800" :class="menuOpen ? 'fa-square-xmark' : 'fa-magnifying-glass'" />
        </button>
        
        <div class="menu" :class="menuOpen ? 'menu-open' : ''">
            <div class="inline-block">
                <div class="bg-emerald-400 space-y-4 lg:space-y-8 px-2 py-4 lg:p-8 h-screen md:h-auto">
                    <h3 class="text-center mb-4 lg:mb-8">Zoeken op:</h3>
                        
                    <form @submit.prevent>
                        <div class="space-y-4 lg:space-y-8 px-4">
                            <div v-for="(options, name) in features" :key="name">
                                <select-form :feature="{ 'name': name, 'options': options }" @select="add" />
                            </div>
                        </div>
                    </form>
                    
                    <div v-if="criteria">
                        <h3 class="text-center mb-4">Zoekcriteria:</h3>
                        
                        <div class="space-y-4 text-xs lg:text-sm">
                            <div v-for="(trait, name) in selected" :key="name">
                                <div v-if="trait.length" class="font-semibold text-gray-700 mb-1">{{ getLabel(name) }}:</div>
                                <div class="space-x-1 space-y-1">
                                    <div v-for="(id, index) in trait" :key="index" class="inline-block">
                                        <div class="selected-box">
                                            <a class="btn-remove" @click="remove(name, index)">
                                                <i class="fa-solid fa-xmark" />
                                            </a>
                                            
                                            <span class="selected-option">{{ Object.values(features[name][parseInt(id) - 1])[1] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="flex justify-center">
                        <button @click="search" class="bg-white font-semibold text-emerald-700 border border-emerald-700 hover:text-emerald-900 hover:border-emerald-900 p-2 rounded-lg">Zoeken</button>
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
                    window.scrollTo(0,0);
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
