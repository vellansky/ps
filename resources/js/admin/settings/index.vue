<template>
    <div class="flex flex-nowrap gap-x-10">
        <div class="w-2/6">
            <adminSettingsMenu />
        </div>
        <div class="w-full">
            <router-view></router-view>
        </div>
        
    </div>
</template>
<script>
import adminSettingsMenu from './menu.vue'
export default {
    components:{
        adminSettingsMenu,
    },
}
</script>
