<template>
    <div>
        <form @submit.prevent>
            <div v-for="(options, name) in features" :key="name" style="margin: 20px;">
                <single-feature :feature="{ 'name': name, 'options': options }" @select="add" />
        
                <div>
                    <div>Selected {{ name }}:</div>
                    
                    <div v-for="(id, index) in selected[name]" :key="index">
                        {{ Object.values(features[name][parseInt(id) - 1])[1] }}
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
            
            search() {
                let ids;
                let params = [];
                
                for (const [key, values] of Object.entries(this.selected)) {
                    if (values.length) {
                        ids = values.join('+');
                    
                        params.push(`${key.substring(0, key.length - 1)}=${ids}`);
                    }
                }
                
                const url = `/birds?${params.join('&')}`;
                
                const response = axios.get(url).then((response) => {
                    console.log(response.data)
                });
            }
        }
    }
</script>
