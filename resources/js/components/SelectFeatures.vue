<template>
    <div>
        <form @submit.prevent>
            <label for="color-select">Kleur:</label>
            <select v-model="color" id="color-select" name="color" @change="addSelected">
                <option v-for="(color, index) in features.colors" :key="index" :value="color.id">{{ color.type }}</option>
            </select>
            
            <div>
                <div>Selected color:</div>
                <div v-for="(color, index) in selected.color" :key="index">
                    {{ color.type }}
                </div>
            </div>
            
            <label for="behavior-select">Gedrag:</label>
            <select v-model="behavior" id="behavior-select" name="behavior" @change="addSelected">
                <option v-for="(behavior, index) in features.behaviors" :key="index" :value="behavior.id">{{ behavior.description }}</option>
            </select>
            
            <label for="shape-select">Vorm:</label>
            <select v-model="shape" id="shape-select" name="shape" @change="addSelected">
                <option v-for="(shape, index) in features.shapes" :key="index" :value="shape.id">{{ shape.appearance }}</option>
            </select>
            
            <label for="habitat-select">Leefgebied:</label>
            <select v-model="habitat" id="habitat-select" name="habitat" @change="addSelected">
                <option v-for="(habitat, index) in features.habitats" :key="index" :value="habitat.id">{{ habitat.name }}</option>
            </select>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['features'],
        
        data() {
            return {
                color: this.features.colors,
                behavior: this.features.behaviors,
                shape: this.features.shapes,
                habitat: this.features.habitats,
                selected: {
                    'color': [],
                    'behavior': [],
                    'shape': [],
                    'habitat': []
                }
            }
        },
        
        methods: {
            addSelected(event) {
                this.selected[event.target.name].push(event.target.value);
                
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
                
                console.log(url);
                
                const response = axios.get(url).then((response) => {
                    console.log(response.data)
                });
            }
        }
    }
</script>
