<template>
    <div class="table text-sm w-full">
        <div class="table-header-group">
            <div class="table-row font-semibold">
                <div class="table-cell text-left">Имя</div>
                <div class="table-cell text-left">Адрес</div>
            </div>
        </div>
        <div class="table-row-group">
            <div class="table-row cursor-default text-xs text-gray-500"  v-for="(shop,index) in shops" @click="active({action:'shop', id: shop.id})" :class="{'bg-gray-700/30': index % 2}">
                <div class="table-cell text-gray-200"><div class="ml-3 my-1">{{shop.name}}</div></div>
                <div class="table-cell">
                    <div class="flex space-x-1">
                        <p>{{shop.country}},</p>
                        <p>{{shop.city}},</p>
                        <p>{{shop.street}},</p>
                        <p>{{shop.house_number}},</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    methods:{
        ...mapActions([
            'adminUpdateShops',
            'adminSelectSettingShop',
            'managerShopMenu',
            'shopEditId'
        ]),
        active(data){
            this.shopEditId(data.id)
            this.managerShopMenu(data)

        },
    },
    mounted() {
        this.adminUpdateShops()
    },
    computed:{
        ...mapGetters([
            'adminGetShops',
        ]),
        shops(){
            return this.adminGetShops
        }

    }
}
</script>
