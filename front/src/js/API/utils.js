import fetchIntercept from 'fetch-intercept'

export const BASE_URL = window.env.API_URL
export const register = () => {
     fetchIntercept.register({
        request(url, config) {
            config = config || {}
            config.headers = config.headers || {}

            config.headers = {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                ...config.headers
            }
            return [url, config]
        }
    })
}
export const afterRequest = async (response, responseType) => {
    if (response.status > 299) {
        throw await response.json()
    }
    const json = await response.json()

    switch (responseType) {
        case 'data':
            return await json.data
        case 'json':
            return await json
        default:
            throw new Error("Unsupported response type. Cases are: \"data\", \"json\".");
    }
}



export const baseCustomRequest = async ({
                                            method = 'GET',
                                            url,
                                            query = null,
                                            body = null,
                                            headers = null,
                                            responseType = 'json'
                                        }) => {
    const requestURL = new URL(
        BASE_URL + url
    )

    if (query) {
        Object.keys(query)
            .filter(key => query[key] !== null && query[key] !== void 0)
            .forEach(key => requestURL.searchParams.append(key, query[key]))
    }

    const response = await fetch(requestURL, {
        method,
        body: body instanceof FormData ? body : body ? JSON.stringify(body) : null,
        headers
    })
    return afterRequest(response, responseType)
}

register()
