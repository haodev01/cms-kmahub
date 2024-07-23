class Fetcher {
    constructor(baseUrl = '/') {
    }

    call(method, url, params, config = {}) {
        let configs = {
            method: method,
            url: url,
            data: params
        }
        configs = Object.assign({}, configs, config)
        console.log('configs', configs)
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax(configs);
    }

    get(url, params, config = {}) {
        this.call('GET', url, params)
    }

    post(url, params, config = {}) {
        this.call('POST', url, params, config)
    }

    put(url, params, config = {}) {
        this.call('PUT', url, params, config)
    }

    delete(url, params, config = {}) {
        this.call('DELETE', url, params, config)
    }
}
