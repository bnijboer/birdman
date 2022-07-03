<template>
            <div class="flex flex-col rounded-lg shadow-md">
                <div class="relative">
                    <img :src="getImagePath(bird.dutch_name)" alt="/images/bird-default.jpg" class="thumbnail">
                    
                    <div v-if="bird.image_attribution" class="absolute bottom-0 w-full text-[9px] tracking-widest bg-black/[.4] text-gray-100 py-1 pl-2">
                        Foto: 
                        
                        <span v-if="bird.image_attribution_url">
                            <a :href="bird.image_attribution_url" target="_blank" class="italic">{{ bird.image_attribution }}</a>
                        </span>
                        <span v-else class="italic">{{ bird.image_attribution }}</span><span v-if="bird.image_edited_by">, bewerking: <span class="italic">{{ bird.image_edited_by }}</span></span>
                        
                        <span v-if="bird.image_cc_license && bird.image_cc_license_url">
                            / <a :href="bird.image_cc_license_url" target="_blank">{{ bird.image_cc_license }}</a>
                        </span>
                        
                        <span v-if="bird.image_gnu_license && bird.image_gnu_license_url">
                            / <a :href="bird.image_gnu_license_url" target="_blank">{{ bird.image_gnu_license }}</a>
                        </span>
                    </div>
                </div>
                <div class="grow text-center text-white bg-emerald-700 p-4">
                    <div class="uppercase font-semibold tracking-wide text-lg">{{ bird.dutch_name }}</div>
                    
                    <!-- <div v-if="bird.rarity">
                        <svg class="rarity-icon" :fill="getRarityColor(bird.rarity)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M279.6 160.4C282.4 160.1 285.2 160 288 160C341 160 384 202.1 384 256C384 309 341 352 288 352C234.1 352 192 309 192 256C192 253.2 192.1 250.4 192.4 247.6C201.7 252.1 212.5 256 224 256C259.3 256 288 227.3 288 192C288 180.5 284.1 169.7 279.6 160.4zM480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6V112.6zM288 112C208.5 112 144 176.5 144 256C144 335.5 208.5 400 288 400C367.5 400 432 335.5 432 256C432 176.5 367.5 112 288 112z"/></svg>
                    </div> -->
                    
                    <div class="p-2">Wanneer te zien: <span class="lowercase">{{ bird.when_to_spot }}</span></div>
                    
                    <a :href="getExternalLink(bird.dutch_name)" target="_blank" class="underline">Meer informatie</a>
                </div>
            </div>
</template>

<script>
    export default {
        // props: ['result'],
        props: ['bird'],
        
        methods: {
            // getRarityColor(rarityGrade) {
            //     let color;
                
            //     switch (rarityGrade) {
            //         case 1:
            //             color = '#000';
            //         break;
            //         case 2:
            //             color = '#d4d4d8'
            //         break;
            //         case 3:
            //             color = '#ffff00';
            //         break;
            //         case 4:
            //             color = '#d50000';
            //         break;
            //         default:
            //             color = '#fff';
            //     }
                
            //     return color;
            // },
            
            getImagePath(name) {
                return "/images/" + name + ".jpg";
            },
            
            getExternalLink(name) {
                let segment = name.replace(/[']|\s/g, '-');
                
                return "https://www.vogelbescherming.nl/ontdek-vogels/kennis-over-vogels/vogelgids/vogel/" + segment;
            }
        }
    }
</script>