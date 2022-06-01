<template>
    <div class="results-container" :class="{ 'no-results': noResults }">
        <div v-if="noResults" class="no-results-overlay">
            <div class="mt-4">
                <h1>Oh nee!</h1>
                <div class="no-results-message">We konden geen vogels vinden...</div>
            </div>
        </div>
        <div v-else class="results-overlay">
            data
        </div>
    </div>
</template>

<script>
    export default {
        // props: ['results'],
        
        data() {
            return {
                noResults: false,
            }
        }
    }
</script>