<template>
    <div class="field-container">
        <label :for="name">{{ label }}</label>
        <select v-model="feature.name" :id="name" :name="name" @change="select">
            <option v-for="(option, index) in options" :key="index" :value="option.id">
                <!-- {{ getDescription(option) }} -->
                {{ Object.values(option)[1] }}
            </option>
        </select>
    </div>
</template>

<script>
    export default {
        props: [
            'feature'
        ],
        
        data() {
            return {
                name: this.feature.name,
                options: this.feature.options
            }
        },
        
        computed: {
            label() {
                let label;
                
                switch(this.name) {
                    case 'colors':
                        label = 'Kleur';
                    break;
                    case 'behaviors':
                        label = 'Gedrag';
                    break;
                    case 'shapes':
                        label = 'Kenmerken';
                    break;
                    case 'habitats':
                        label = 'Leefgebied';
                    break;
                }
                
                return label;
            }
        },
        
        methods: {
            // getDescription(option) {
            //     let pretext;
                
            //     switch(this.name) {
            //         case 'behaviors':
            //             pretext = 'Vogels die ';
            //         break;
            //         case 'shapes':
            //             pretext = 'Het lijkt op een ';
            //         break;
            //         case 'habitats':
            //             pretext = 'Ik ben ';
            //         break;
            //     }
                
            //     let description;
                
            //     if (pretext !== undefined) {
            //         description = pretext + Object.values(option)[1];
            //     } else {
            //         description = (Object.values(option)[1])[0].toUpperCase() + (Object.values(option)[1]).slice(1).toLowerCase();
            //     }
                
            //     return description;
            // },
            
            select(event) {
                const selected = {
                    [this.name]: event.target.value
                };
                
                this.$emit('select', selected);
                
                event.target.value = '';
            }
        }
    }
</script>