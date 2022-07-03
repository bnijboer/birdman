<template>
    <div class="h-screen">
        <div v-if="!results" class="relative">
            <h1 class="absolute top-16 w-full text-center uppercase text-white" style="text-shadow: 3px 3px 0px rgba(0,0,0,0.4);">Birdman</h1>
            
            <img src="/images/background.jpg" class="object-cover object-right-bottom h-screen md:hidden"> 
        </div>
        
        <div v-for="(result, index) in results" :key="index" class="py-8 md:px-8">
            <div class="text-center font-semibold mb-8">{{ result.length }} resultaten:</div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="(bird, index) in result" :key="index" class="px-4 sm:px-0">
                    <card :bird="bird" />
                </div>
            <!-- <result :result="result" /> -->
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['results']
    }
</script>