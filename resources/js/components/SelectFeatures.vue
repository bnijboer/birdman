<template>
    <div>
        <form @submit.prevent>
            <label for="color-select">Kleur:</label>
            <select v-model="colors" id="color-select" name="colors" :size="features.colors.length + 1" @change="addSelection">
                <option value="all">Alle kleuren</option>
                <option v-for="(color, index) in features.colors" :key="index" :value="color.id">{{ color.type }}</option>
            </select>
            
            <div>
                <div>Selected colors:</div>
                <div v-for="(color, index) in colorsSelected" :key="index">
                    {{ color.type }}
                </div>
            </div>
            
            <label for="behavior-select">Gedrag:</label>
            <select v-model="behaviors" id="behavior-select" name="behaviors" :size="features.behaviors.length + 1" @change="search">
                <option value="all">Alle soorten gedrag</option>
                <option v-for="(behavior, index) in features.behaviors" :key="index" :value="behavior.id">{{ behavior.description }}</option>
            </select>
            
            <label for="shape-select">Vorm:</label>
            <select v-model="shapes" id="shape-select" name="shapes" :size="features.shapes.length + 1" @change="addSelection">
                <option value="all">Alle vormen</option>
                <option v-for="(shape, index) in features.shapes" :key="index" :value="shape.id">{{ shape.appearance }}</option>
            </select>
            
            <label for="habitat-select">Leefgebied:</label>
            <select v-model="habitats" id="habitat-select" name="habitats" :size="features.habitats.length + 1" @change="search">
                <option value="all">Alle leefgebieden</option>
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
                colors: ['all'],
                behaviors: ['all'],
                shapes: ['all'],
                habitats: ['all'],
                colorsSelected: [],
                selection: {
                    'colors': [],
                    'shapes': []
                }
            }
        },
        
        methods: {
            addSelection(event) {
                // console.log(this.selection);
                
                this.selection[event.target.name].push(event.target.value);
                
                this.search();
            },
            
            search() {
                let params = [];
                
                for (const [key, value] of Object.entries(this.selection)) {
                    if (value.length) {
                        let values = value.join('+');
                    
                        params.push(`${key}=${values}`);
                    }
                }
                
                let query = params.join('&');
                console.log(query);
                
                // let color = this.colorsSelected.map(item => {
                //     return item.id
                // }).join('+');
                
                // let params = Object.keys(this.features).map(key => {
                //     return `${key}=${color}`
                // }).join('&');
                
                // console.log(params);
                
                // let behavior = this.behaviors.join('+');
                // let shape = this.shapes.join('+');
                // let habitat = this.habitats.join('+');
                
                const response = axios.get(`/birds?color=${color}&behavior=${behavior}&shape=${shape}&habitat=${habitat}`).then((response) => {
                    console.log(response.data)
                });
            }
        }
    }
</script>
