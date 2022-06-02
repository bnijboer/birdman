<template>
    <!-- <div class="results-container" :class="{ 'no-results': noResults }">
        <div v-if="noResults" class="no-results-overlay">
            <div class="mt-4">
                <h1>Oh nee!</h1>
                <div class="no-results-message">We konden geen vogels vinden...</div>
            </div>
        </div>
        <div v-else class="results-overlay">
            <div v-for="(bird, index) in results" :key="index">
                {{ bird }}
            </div>
        </div>
    </div> -->
    
    <div class="results-container">
        <div class="results-overlay">
            <div v-for="(result, index) in results" :key="index">
                <div v-for="(bird, index) in result" :key="index">
                    {{ bird.dutch_name }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['results'],
        
        data() {
            return {
                //
            }
        },
        
        computed: {
            // noResults() {
            //     let noResults = true;
                
            //     if (this.results) {
            //         noResults = false;
            //     }
                
            //     return noResults;
            // }
        }
    }
</script>