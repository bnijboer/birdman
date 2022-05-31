<template>
    <div>
        <form @submit.prevent>
            <label for="color-select">Kleur:</label>
            <select v-model="colors" id="color-select" name="colors" size="15" multiple @change="search">
                <option value="all">Alle kleuren</option>
                <option v-for="(color, index) in features.colors" :key="index" :value="color.id">{{ color.type }}</option>
            </select>
            
            <label for="behavior-select">Kleur:</label>
            <select v-model="behaviors" id="behavior-select" name="behaviors" size="15" multiple @change="search">
                <option value="all">Alle kleuren</option>
                <option v-for="(behavior, index) in features.behaviors" :key="index" :value="behavior.id">{{ behavior.description }}</option>
            </select>
            
            <label for="shape-select">Vorm:</label>
            <select v-model="shapes" id="shape-select" name="shapes" size="11" multiple @change="search">
                <option value="all">Alle vormen</option>
                <option v-for="(shape, index) in features.shapes" :key="index" :value="shape.id">{{ shape.appearance }}</option>
            </select>
            
            <label for="habitat-select">Leefgebied:</label>
            <select v-model="habitats" id="habitat-select" name="habitats" size="10" multiple @change="search">
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
            }
        },
        
        methods: {
            search(event) {
                let color = this.colors.join('+');
                let behavior = this.behaviors.join('+');
                let shape = this.shapes.join('+');
                let habitat = this.habitats.join('+');
                
                const response = axios.get(`/birds?color=${color}&behavior=${behavior}&shape=${shape}&habitat=${habitat}`).then((response) => {
                    console.log(response.data)
                });
            }
        }
    }
</script>
