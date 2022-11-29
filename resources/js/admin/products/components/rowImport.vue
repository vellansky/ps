<template>
    <tr :class="{'bg-green-500': !attention, 'bg-gray-500, border-4' : attention}">
            
            <td class="border text-center w-96">
                <div>
                    <input class="w-full border-0 pl-2 text-sm" type="text"
                    :value="name"
                    @input="$emit('update:name', $event.target.value)">
                </div>
            </td>
            <td class="border">
                <div>
                        <input class="w-full border-0 pl-2 text-sm" type="text"
                        :value="code"
                        @input="$emit('update:code', $event.target.value)">
                </div>
            </td>
            <td class="border">
                <div>
                        <input class="w-full border-0 pl-2 text-sm" type="text"
                        :value="city"
                        @input="$emit('update:city', $event.target.value)">
                </div>
            </td>
            <td class="border">
                <div>
                        <input class="w-full border-0 pl-2 text-sm" type="text"
                        :value="quantity"
                        @input="$emit('update:quantity', $event.target.value)">
                </div>
            </td>
            <td class="border">
                <div>
                        <input class="w-full border-0 pl-2 text-sm" type="text"
                        :value="price"
                        @input="$emit('update:price', $event.target.value)">
                </div>
            </td>
            <td class="border">
                <div>
                        <input class="w-full border-0 pl-2 text-sm h-max" type="text"
                        :value="description"
                        @input="$emit('update:description', $event.target.value)">
                </div>
            </td>
        </tr>
</template>
<script>
export default {
    props: ['name', 'code', 'city','quantity', 'price', 'description'],
    emits: ['update:name', 'update:code', 'update:city', 'update:quantity', 'update:price', 'description'],
    data() {
        return {
            attention: null
        };
  },
  methods:{
      check(){
          if (!this.code || !this.name) {
            this.attention = true;
        }
      }
  },
    mounted() {
        this.check()
    }
}
</script>
