<template>
    <div class="table-row cursor-default text-xs text-gray-500 " >
        <div class="table-cell text-gray-200">
            {{name}}
        </div>
        <div class="table-cell">
            <div class="flex justify-center space-x-5">
                <p >-</p>
                <p>{{item.pivot.quantity}}</p>
                <p >+</p>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    props:['index','id','name','quantity'],
    computed:{
        quantity:{

        }
    },
}

</script>
