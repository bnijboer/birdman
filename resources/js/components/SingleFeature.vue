<template>
    <div>
        <label :for="name">{{ name }}</label>
        
        <select v-model="feature.name" :id="name" :name="name" @change="select">
            <option v-for="(option, index) in options" :key="index" :value="option.id">{{ Object.values(option)[1] }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ['feature'],
        
        data() {
            return {
                name: this.feature.name,
                options: this.feature.options
            }
        },
        
        methods: {
            select(event) {
                const selected = {
                    [this.name]: event.target.value
                };
                
                this.$emit('select', selected);
            }
        }
    }
</script>