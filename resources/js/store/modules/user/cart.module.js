const state = {
    cart: [],
}
const mutations = {
    pushToCart(state, product){
        state.cart.push(product)
    },
    plusQuantity(state, index) {
        state.cart[index].cartQuantity++

    },
    minusQuantity(state, index) {
        state.cart[index].cartQuantity--
    },
    removeProduct(state, index) {
        state.cart.splice(index,1)
    }
}
const getters = {
    cartProducts(state){
        return state.cart
    },
    cartProductQuantity: (state) => (id) => {
        if(id) {
            const cartProduct = state.cart.find(p => p.product_id === id)
            if(!cartProduct) {
                return 0
            } else {
                if('cartQuantity' in cartProduct) {
                    return cartProduct.cartQuantity
                } else {
                    return 0
                }
            }
        }
    }
}
const actions = {
    addToCart({commit,getters}, data) {
        console.log(data)

        const stock = data.product.quantity > 0
        
        if (data.action === 'minus') {
            let p = getters.cartProducts.find(cartProduct => cartProduct.product_id === data.product.product_id)
                if (p !== undefined) {
                    if ('cartQuantity' in p) {
                        let index = getters.cartProducts.findIndex(cartProduct => cartProduct.product_id === data.product.product_id)
                        if(p.cartQuantity <= 1) {
                            commit('removeProduct', index)
                        } else {
                            commit('minusQuantity', index)
                        }
                        data.product.quantity++
                    } else {
                        console.log('Необъяснимо, но факт')
                    }
                } else {
                    console.log(data)
                    console.log('Нужно добавить товар в корзину')
                }

        } else {
            if (stock){
                let inCart = getters.cartProducts.find(cartProduct => cartProduct.product_id === data.product.product_id)
                if (!inCart) { 
                    data.product.cartQuantity = 1
                    commit('pushToCart', data.product)
                } else {
                    let index = getters.cartProducts.findIndex(cartProduct => cartProduct.product_id === data.product.product_id)
                    commit('plusQuantity', index)
                }
                data.product.quantity--
            } else {
                console.log('нет в наличии')
            }
        }
    }
}
export default {
    state,
    getters,
    actions,
    mutations,
};
