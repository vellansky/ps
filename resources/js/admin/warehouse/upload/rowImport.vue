<template>
    <tr :class="{'bg-gray-700':evenRow(index), 'bg-yellow-50/80': check }" class="text-white">
            <td class="text-center w-96">
                <div>
                    <input class="w-full pl-2 text-sm bg-inherit border-0" type="text"
                    :value="name"
                    @input="$emit('update:name', $event.target.value)">
                </div>
            </td>
            <td>
                <div>
                        <input class="w-full pl-2 text-sm bg-inherit border-0" type="text"
                        :value="code"
                        @input="$emit('update:code', $event.target.value)">
                </div>
            </td>
            <td>
                <div>
                        <input class="w-full pl-2 text-sm bg-inherit border-0" type="text"
                        :value="quantity"
                        @input="$emit('update:quantity', $event.target.value)">
                </div>
            </td>
            <td>
                <div>
                        <input class="w-full pl-2 text-sm bg-inherit border-0" type="text"
                        :value="price"
                        @input="$emit('update:price', $event.target.value)">
                </div>
            </td>
            <td>
                <div>
                        <input class="w-full pl-2 text-sm bg-inherit border-0 h-max" type="text"
                        :value="description"
                        @input="$emit('update:description', $event.target.value)">
                </div>
            </td>
        </tr>
</template>
<script>
export default {
    props: ['index','name', 'code', 'quantity', 'price', 'description'],
    emits: ['update:name', 'update:code', 'update:quantity', 'update:price', 'description'],
    data() {
        return {
            attention: null
        };
  },
  methods:{
      evenRow(index){
          let resulte = index % 2
          return resulte

      },

  },

    computed:{
        check(){
            let result = !this.code || !this.name
            return result
        }
    }
}
</script>
