<template>
    <div>
        <form @submit.prevent>
            <div v-for="(options, name) in features" :key="name" style="margin: 20px;">
                <single-feature :feature="{ 'name': name, 'options': options }" @select="add" />
        
                <div>
                    <div>Gekozen {{ getTranslatedFeature(name) }}:</div>
                    
                    <div v-for="(id, index) in selected[name]" :key="index">
                        {{ Object.values(features[name][parseInt(id) - 1])[1] }}
                        
                        <a @click="remove(name, index)">Remove</a>
                    </div>
                </div>
            </div>
        </form>
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
                }
            }
        },
        
        methods: {
            add(event) {
                let trait = Object.keys(event)[0];
                let id = Object.values(event)[0];
                
                this.selected[trait].push(id);
                
                this.search();
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
                
                const response = axios.get(url).then((response) => {
                    console.log(response.data)
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
