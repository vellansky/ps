<template>
    <tr class="hover:bg-gray-200">
        <td class="text-center"><input class="h-3 w-3 mx-1" type="checkbox"></td>
        <td class="text-center">{{id}}</td>
        <td>{{city}}</td>
        <td>{{name}}</td>
        <td v-for="(category,index) in categories" :key="index">{{category.name}}</td>
        <td class="select-all">{{code}}</td>
        <td>{{quantity}}</td>
        <td>{{price}}</td>
    </tr>
</template>
<script>
export default {
    props:['id', 'city', 'categories', 'name', 'code', 'quantity', 'price' ]
}
</script>
