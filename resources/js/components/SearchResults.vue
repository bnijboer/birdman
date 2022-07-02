<template>
    <div class="results-container">
        <div v-for="(result, index) in results" :key="index">
            <div class="text-center font-semibold mb-8">{{ result.length }} resultaten:</div>
            
            <result :result="result" />
        </div>
    </div>
</template>

<script>
    export default {
        props: ['results'],
        
        // make call to BirdController with optional birdcollection argument
        // in BirdController, if no collection parameter is provided, fetch all birds
        // if collection is provided, filter collection using queryscopes
        // return results as json
        
    }
</script>