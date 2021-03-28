import {baseCustomRequest} from './utils'

const API = {
  getProductAvailability(
    product,
  ) {
    return baseCustomRequest({
      url: `/product/availability`,
      query: {
        product,
      }
    })
  },

  getProducts() {
    return baseCustomRequest({
      url: `/product`,
    })
  },
}

export default API
