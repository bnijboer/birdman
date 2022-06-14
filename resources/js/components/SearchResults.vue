<template>
    <div class="results-container">
        <div v-for="(result, index) in results" :key="index">
            <result :result="result" />
        </div>
    </div>
</template>

<script>
    export default {
        props: ['results']
    }
</script>