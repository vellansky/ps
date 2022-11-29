<template>
    <div v-if="notification.status" class="fixed top-10 right-10 w-72 h-20 bg-black/30 bg-blue-500 shadow-lg shadow-white/30 rounded-xl z-50">
        <div class="px-5 pt-3 text-white text-sm">
            <div>
                <h6 class="font-semibold">{{ notification.text.title }}</h6>
                <p class="text-xs">{{ notification.text.body }}</p>
            </div>
        </div>

    </div>
</template>

<script>
import { mapGetters} from 'vuex'
export default {
    computed:{
        ...mapGetters([
            'adminNotification'
        ]),
        notification(){
            return this.adminNotification
        }
    }
}
</script>
